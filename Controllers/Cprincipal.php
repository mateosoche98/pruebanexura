<?php
require_once('Models/Mprincipal.php');
	class Main{

		public $model;

		public function __construct(){
			$this->model=new Modelo();
		}

		public function index(){
			require_once('Views/home.php');
		}

		public function nuevo(){
			require_once('Views/nuevo.php');
		}

		public function guardar(){
			function comprobar_email($email){
			   $mail_correcto = 0;
			   if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){
			      if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) {
			         if (substr_count($email,".")>= 1){
			            $term_dom = substr(strrchr ($email, '.'),1);
			            if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
			               $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
			               $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
			               if ($caracter_ult != "@" && $caracter_ult != "."){
			                  $mail_correcto = 1;
			               }
			            }
			         }
			      }
			   }
			   if (!$mail_correcto){
			   	echo '<script>alert("Correo no pertenece al dominio gmail,hotmail,outlook");window.location.href="index.php"</script>';
			   	die();
			   }
			}
			comprobar_email($_POST['Ema']);
			$alm = new Modelo();
			$alm->Nom=$_POST['Nom'];
			$alm->Ema=$_POST['Ema'];
			$alm->Sex=$_POST['Sex'];
			$alm->Are=$_POST['Are'];
			$alm->Des=$_POST['Des'];
			$alm->Bol=$_POST['Bol'];
			$alm->Rol=$_POST['Rol'];
			$this->model->guardardatos($alm);
		}

		public function viewedit(){
			$traer=new Modelo();
			$traer=$this->model->traerdatos($_REQUEST['id']);
			$arreglorol=$this->model->traerroles($_REQUEST['id']);
			require_once('Views/editar.php');
		}

		public function guardaredit(){
			function comprobar_email($email){
			   $mail_correcto = 0;
			   if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){
			      if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) {
			         if (substr_count($email,".")>= 1){
			            $term_dom = substr(strrchr ($email, '.'),1);
			            if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
			               $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
			               $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
			               if ($caracter_ult != "@" && $caracter_ult != "."){
			                  $mail_correcto = 1;
			               }
			            }
			         }
			      }
			   }
			   if (!$mail_correcto){
			   	echo '<script>alert("Correo no pertenece al dominio gmail,hotmail,outlook");window.location.href="index.php"</script>';
			   	die();
			   }
			}
			comprobar_email($_POST['Ema']);
			$alm = new Modelo(); 
			$alm->id=$_POST['id'];
			$alm->Nom=$_POST['Nom'];
			$alm->Ema=$_POST['Ema'];
			$alm->Sex=$_POST['Sex'];
			$alm->Are=$_POST['Are'];
			$alm->Des=$_POST['Des'];
			$alm->Bol=$_POST['Bol'];
			$alm->Rol=$_POST['Rol'];
			$this->model->guardaredit($alm);
		}

		public function eliminar(){
			$eli=new Modelo();
			$eli=$this->model->eliminar($_REQUEST['id']);
		}
	}
?>
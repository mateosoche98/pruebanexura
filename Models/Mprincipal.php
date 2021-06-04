<?php 
	class Modelo{

		public $CNX;
		public $Nom;
		public $Ema;
		public $Sex;
		public $Are;
		public $Des;
		public $Bol;
		public $Rol;
		public $id;

		public function __construct(){
			$this->CNX=conexion::conectar();
		}

		public function listar(){
			try {
				$sql="SELECT T1.id,T1.nombre as NombreEmp, T1.email, T1.sexo, T1.area_id,T1.boletin,T2.nombre as areaNom, GROUP_CONCAT(CONCAT_WS(',', T4.nombre))as Nomrol FROM empleados T1 INNER JOIN areas T2 ON T1.area_id=T2.id INNER JOIN empleado_rol T3 ON T1.id=T3.empleado_id INNER JOIN roles T4 ON T3.rol_id=T4.id GROUP BY T1.id";
				$stmt=$this->CNX->query($sql);
				$stmt->execute();
				return $stmt->FETCHALL(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function SelectAreas(){
			try {
				$sql="SELECT * FROM areas";
				$stmt=$this->CNX->query($sql);
				$stmt->execute();
				return $stmt->FETCHALL(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function Roles(){
			try {
				$sql="SELECT * FROM roles";
				$stmt=$this->CNX->query($sql);
				$stmt->execute();
				return $stmt->FETCHALL(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function guardardatos(Modelo $data){
			if ($data->Bol==1) {
				$bolet=1;
			}else{
				$bolet=0;
			}
			$sql="INSERT INTO empleados (nombre,email,sexo,area_id,boletin,descripcion) VALUES (:Nom,:Ema,:Sex,:Are,:Bol,:Des)";
			$stmt=$this->CNX->prepare($sql);
			$stmt->execute(array(
				':Nom' => $data->Nom,
				':Ema' => $data->Ema,
				':Sex' => $data->Sex,
				':Are' => $data->Are,
				':Bol' => $bolet,
				':Des' => $data->Des,
			));
			$sql1="SELECT id FROM empleados order by id desc limit 1";
			$stmt1=$this->CNX->prepare($sql1);
			$stmt1->execute();
			 $traerid=$stmt1->FETCHALL();
			 foreach ($data->Rol as $rolcon) {
			 	$sql="INSERT INTO empleado_rol (empleado_id,rol_id) VALUES (:empleado_id,:rol_id)";
				$stmt=$this->CNX->prepare($sql);
				$stmt->execute(array(
					':empleado_id' => $traerid[0][0],
					':rol_id' => $rolcon,
				));
			}
			echo '<script>alert("Registrado Correctamente");window.location.href="index.php"</script>';
		}

		public function traerdatos($id){
			$sql="SELECT T1.id,T1.nombre as NombreEmp, T1.email, T1.sexo, T1.area_id,T1.boletin,T2.nombre as areaNom, T1.descripcion,T3.rol_id FROM empleados T1 INNER JOIN areas T2 ON T1.area_id=T2.id INNER JOIN empleado_rol T3 ON T1.id=T3.empleado_id WHERE T1.id=:id";
			$stmt=$this->CNX->prepare($sql);
			$stmt->execute(array(
				':id' => $id,
			));
			if ($stmt->rowCount()==0) {
				echo '<script>alert("Id nulo o inexistente");window.location.href="index.php"</script>';
			}else{
				return $stmt->FETCH(PDO::FETCH_OBJ);
			}
		}

		public function traerroles($id){
			$sql="SELECT * from empleado_rol WHERE empleado_id='".$id."'";
			$stmt=$this->CNX->query($sql);
			while ($row=$stmt->fetch()) {
				$rolesarre[]=$row[1];
			}
			return $rolesarre;
		}

		public function guardaredit(Modelo $data){
			if ($data->Bol==1) {
				$bolet=1;
			}else{
				$bolet=0;
			}
			$sql="UPDATE empleados SET nombre=:Nom,email=:Ema,sexo=:Sex,area_id=:Are,boletin=:Bol,descripcion=:Des WHERE id=:id";
			$stmt=$this->CNX->prepare($sql);
			$stmt->execute(array(
				':Nom' => $data->Nom,
				':Ema' => $data->Ema,
				':Sex' => $data->Sex,
				':Are' => $data->Are,
				':Bol' => $bolet,
				':Des' => $data->Des,
				':id' => $data->id,
			));
			$sql="DELETE FROM empleado_rol where empleado_id=:empleado_id";
			$stmt=$this->CNX->prepare($sql);
			$stmt->execute(array(
				':empleado_id' => $data->id,
			));
			 foreach ($data->Rol as $rolcon) {
			 	$sql="INSERT INTO empleado_rol (empleado_id,rol_id) VALUES (:empleado_id,:rol_id)";
				$stmt=$this->CNX->prepare($sql);
				$stmt->execute(array(
					':empleado_id' => $data->id,
					':rol_id' => $rolcon,
				));
			}
			echo '<script>alert("Editado Correctamente");window.location.href="index.php"</script>';
		}

		public function eliminar($id){
			$sql="DELETE FROM empleados WHERE id=:id";
			$stmt=$this->CNX->prepare($sql);
			$stmt->execute(array(
				':id' => $id,
			));
			$sql="DELETE FROM empleado_rol WHERE empleado_id=:id";
			$stmt=$this->CNX->prepare($sql);
			$stmt->execute(array(
				':id' => $id,
			));
			echo '<script>alert("Eliminado Correctamente");window.location.href="index.php"</script>';
		}

	}
?>
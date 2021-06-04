<?php
class conexion{
	public static function conectar(){
		//database credentials
			$db = new PDO("mysql:host=localhost;dbname=empleado;charset=utf8","root","");
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $db;
	}
}
?>

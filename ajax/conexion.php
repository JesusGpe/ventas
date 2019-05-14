<?php 
	
	function conectar(){
		$server = "localhost";
		$user = "root";
		$password = "";
		$db = "ventas";

		$conexion = mysqli_connect($server,$user,$password,$db);

		return $conexion;
	}

 ?>
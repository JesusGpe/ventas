<?php 
	
	session_start();

	include 'conexion.php';
	
	$conexion = conectar();
	
	$sql = "select * from usuarios where email = '".$_POST['email'] ."' and password = '".$_POST['password']."'";
	
	$result = mysqli_query($conexion,$sql);

	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
	if($count == 1){
		$_SESSION["id"] = $row["id"];
		$_SESSION["nombre"] = $row["nombre"];
		echo json_encode(array("mensaje"=>"Bienvenido ".$row["nombre"],"error"=>false));
	}else{
		echo json_encode(array("mensaje"=>"Usuario o contraseña incorrectos!","error"=>true));
	}



 ?>
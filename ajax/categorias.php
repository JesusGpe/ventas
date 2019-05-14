<?php 
	
	include("conexion.php");

	function registrar(){

		$conexion = conectar();

		$sql = "insert into categorias (nombre,descripcion) values ('".$_POST['nombre']."','".$_POST['descripcion']."')";

		$result = mysqli_query($conexion,$sql);

		if($result){
			echo json_encode(array("error" => false,"mensaje" => "Categoria registrada"));
		}
		else{
			echo json_encode(array("error" => true,"mensaje" => "Categoria no registrada"));
		}


	}

	function editar(){

		$conexion = conectar();

		$sql = "update categorias set nombre = '".$_POST['nombre']."', descripcion = '".$_POST['descripcion']."' where id =".$_POST['id'];

		$result = mysqli_query($conexion,$sql);

		if($result){
			echo json_encode(array("error" => false,"mensaje" => "Categoria editada"));
		}
		else{
			echo json_encode(array("error" => true,"mensaje" => "Categoria no editada"));
		}


	}

	function eliminar(){

		$conexion = conectar();

		$sql = "delete from categorias where id = ".$_POST["id"];

		$result = mysqli_query($conexion,$sql);

		if($result){
			echo json_encode(array("error" => false,"mensaje" => "Categoria eliminada"));
		}
		else{
			echo json_encode(array("error" => true,"mensaje" => "Categoria no eliminada"));
		}


	}


	switch ($_POST["opc"]) {
		case 'registrar':
			registrar();
			break;
		case 'editar':
			editar();
			break;
		case 'eliminar':
			eliminar();
			break;
		default:
			# code...
			break;
	}

 ?>
<?php 
	
	include("conexion.php");
	include_once("../objetos/Categorias.php");

	$Categoria = new Categoria();

	
if ($_POST["opc"]) 
{
	if(isset($_POST['id']))
	{
		$id = $_POST['id'];
		$Categoria->setId($id);
	}
	else if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		$Categoria->setId($id);
	}
	else
	{
		$id = 0;
		$Categoria->setId($id);
	}

	if(isset($_POST['nombre']))
	{
		$nombre = $_POST['nombre'];
		$Categoria->setNombre($nombre);
	}
	else if(isset($_GET['nombre']))
	{
		$nombre = $_GET['nombre'];
		$Categoria->setNombre($nombre);
	}
	else
	{
		$nombre = "";
		$Categoria->setNombre($nombre);
	}

	if(isset($_POST['descripcion']))
	{
		$descripcion = $_POST['descripcion'];
		$Categoria->setDescripcion($descripcion);
	}
	else if(isset($_GET['descripcion']))
	{
		$descripcion = $_GET['descripcion'];
		$Categoria->setDescripcion($descripcion);
	}
	else
	{
		$descripcion = "";
		$Categoria->setDescripcion($descripcion);
	}

	switch ($_POST["opc"]) {
		case 'registrar':
			registrar($Categoria);
			break;
		case 'editar':
			editar($Categoria);
			break;
		case 'eliminar':
			eliminar($Categoria);
			break;
		default:
			# code...
			break;
	}

}
 
	function registrar($pCategoria){

		$conexion = conectar();
		
		$sql = "insert into categorias (nombre,descripcion) values ('". $pCategoria->getNombre() ."','". $pCategoria->getDescripcion() ."')";

		$result = mysqli_query($conexion,$sql);

		if($result){
			echo json_encode(array("error" => false,"mensaje" => "Categoria registrada","Datos" => $pCategoria));
		}
		else{
			echo json_encode(array("error" => true,"mensaje" => "Categoria no registrada","Datos" => $pCategoria));
		}


	}

	function editar($pCategoria)
	{

		$conexion = conectar();

		$sql = "update categorias set nombre = '". $pCategoria->getNombre() ."', descripcion = '". $pCategoria->getDescripcion() ."' where id =". $pCategoria->getId();

		$result = mysqli_query($conexion,$sql);

		if($result){
			echo json_encode(array("error" => false,"mensaje" => "Categoria editada","Datos" => $pCategoria));
		}
		else{
			echo json_encode(array("error" => true,"mensaje" => "Categoria no editada","Datos" => $pCategoria));
		}


	}

	function eliminar($pCategoria)
	{

		$conexion = conectar();

		$sql = "delete from categorias where id = ". $pCategoria->getId();

		$result = mysqli_query($conexion,$sql);

		if($result){
			echo json_encode(array("error" => false,"mensaje" => "Categoria eliminada","Datos" => $pCategoria));
		}
		else{
			echo json_encode(array("error" => true,"mensaje" => "Categoria no eliminada","Datos" => $pCategoria));
		}
	}



 ?>
<?php 
include_once("../objetos/Categorias.php");
include_once("../ajax/categorias.php");
error_reporting(E_ERROR);
	$Categoria = new Categoria();
	
	if(isset($_POST['opc']))
	{
		$opcion = $_POST['opc'];
		
	}
	else if(isset($_GET['opc']))
	{
		$opcion = $_GET['opc'];
		
	}
	else
	{
		$opcion = 0;
	}
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

	switch ($opcion) {
		case 'registrar':
			MetodosCategoria::registrar($Categoria);
			break;
		case 'editar':
			MetodosCategoria::editar($Categoria);
			break;
		case 'eliminar':
			MetodosCategoria::eliminar($Categoria);
			break;
		default:
			# code...
			break;
	}

 ?>
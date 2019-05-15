<?php 
session_start();
include_once("../objetos/Usuarios.php");
include_once("../ajax/login/MetodosLogin.php");
error_reporting(E_ERROR);
	$Usuario = new Usuario();
	
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

	if(isset($_POST['email']))
	{
		$email = $_POST['email'];
		$Usuario->setEmail($email);
	}
	else if(isset($_GET['email']))
	{
		$email = $_GET['email'];
		$Usuario->setEmail($email);
	}
	else
	{
		$id = 0;
		$Usuario->setEmail($email);
	}

	if(isset($_POST['password']))
	{
		$password = $_POST['password'];
		$Usuario->setPassword($password);
	}
	else if(isset($_GET['password']))
	{
		$password = $_GET['password'];
		$Usuario->setPassword($password);
	}
	else
	{
		$id = 0;
		$Usuario->setPassword($password);
	}

	
	switch ($opcion) {
		case 'login':
			MetodosLogin::iniciarSesion($Usuario->getEmail(),$Usuario->getPassword());
			break;
		default:
			# code...
			break;
	}

 ?>
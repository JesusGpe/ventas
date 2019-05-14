<?php 
	
	include("conexion.php");

	function registrar(){

		$conexion = conectar();
		$sql = "insert into productos (nombre,descripcion,precio,precio_compra,stock,idcategoria) values ('".$_POST['nombre']."','".$_POST['descripcion']."','".$_POST['precio']."','".$_POST['precio_compra']."','".$_POST['stock']."','".$_POST['idcategoria']."')";

		$result = mysqli_query($conexion,$sql);
		if($result){
			echo json_encode(array("error" => false,"mensaje" => "Producto registrado"));
		}
		else{
			echo json_encode(array("error" => true,"mensaje" => "Producto no registrado"));
						}
		            

	}

	function editar(){

        $conexion = conectar();

		$sql = "update productos set nombre = '".$_POST['nombre']."', descripcion = '".$_POST['descripcion']."', precio = '".$_POST['precio']."', precio_compra = '".$_POST['precio_compra']."', stock = '".$_POST['stock']."', idcategoria = '".$_POST['idcategoria']."' where id =".$_POST['id'];

		$result = mysqli_query($conexion,$sql);

		if($result){
			echo json_encode(array("error" => false,"mensaje" => "Producto editado"));
		}
		else{
			echo json_encode(array("error" => true,"mensaje" => "Producto no editado"));
		}


	}

	function eliminar(){

		$conexion = conectar();

		$sql = "delete from productos where id = ".$_POST["id"];

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
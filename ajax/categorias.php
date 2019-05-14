<?php 
	
	include("conexion.php");
class MetodosCategoria
{ 
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
}


 ?>
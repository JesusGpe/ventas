<?php 
	session_start();
	include("conexion.php");

	function listar(){
		$conexion = conectar();
		$html = "";
		$sql = "select * from carritos where idcliente = ".$_SESSION["id"];
		$result = mysqli_query($conexion,$sql);
		$html.="<table class='table'>";
		$html.="<thead>";
		$html.="<th>Nombre</th>";
		$html.="<th>Cantidad</th>";
		$html.="<th>Precio</th>";
		$html.="<th>Subtotal</th>";
		$html.="<th>Opc</th>";
		$html.="</thead>";
		$html.="<tbody>";
		while ($row = mysqli_fetch_array($result)) {
			$html.="<tr>";
			$html.="<td>".$row['producto']."</td>";
			$html.="<td style='width:150px'><input type='number' value='".$row['cantidad']."' style='width:50px;'/> <button class='btn btn-sm btn-info'>act</button></td>";
			$html.="<td>".$row['precio']."</td>";
			$html.="<td>".$row['subtotal']."</td>";
			$html.="<td><button class='btn btn-sm btn-warning'>X</button></td>";
			$html.="</tr>";
		}
		$html.="</tbody>";
		$html.="</table>";

		echo json_encode(array("html"=>$html));
	}

	function agregar(){
		$conexion = conectar();
		$idcliente = $_POST['idcliente'];
		$producto = $_POST['producto'];
		$cantidad = $_POST['cantidad'];
		$precio = $_POST['precio'];
		$subtotal = $_POST['subtotal'];
		$sql = "insert into carritos (idcliente,producto,cantidad,precio,subtotal) values ('$idcliente','$producto','$cantidad','$precio','$subtotal')";
		$result = mysqli_query($conexion,$sql);

		if($result){
			echo json_encode(array("mensaje"=>"Agregado al carrito","error"=>false));
		}
		else{
			echo json_encode(array("mensaje"=>"No se ha agregado al carrito","error"=>true));
		}
	}

	switch ($_POST['opc']) {
		case 'agregar':
			agregar();
			break;
		case 'listar':
			listar();
			break;
		default:
			break;
	}
 ?>
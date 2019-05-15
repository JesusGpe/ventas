<?php 
class MetodosLogin
{ 
	function iniciarSesion($pEmail,$pPassword){

		$datos = array();
		$datosResponse = array();
		$datos['mensaje'] = "";
		$datos['respuesta'] = 0;
		$datos['infoResponse'];

		if ($pEmail != "" && $pPassword != "") 
		{

		$parametros = "email=" . $pEmail . "&password=" . $pPassword;
			try 
			{
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "http://10.44.150.211:8080/wsventas/getUsuarioLoginWS");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$parametros);
				$datosResponse = curl_exec($ch);
				curl_close($ch); 
				$datos['infoResponse'] = json_decode($datosResponse);
				$datos['mensaje'] = "Servicio getUsuarioLoginWS, Parametros:". $parametros .", Fue Ejecutado Correctamente!.";
				$datos['respuesta'] = 1;

				$data = json_decode($datosResponse);
				$user = $data->respuesta;
				$_SESSION["id"] = $user->id;
				$_SESSION["nombre"] = $user->nombre;
				$_SESSION["apellido"] = $user->apellido;
				$_SESSION["email"] = $user->email;
				$_SESSION["password"] = $user->password;
			} 
			catch (Exception $e) 
			{
				$datos['respuesta'] = -1;
				$datos['mensaje'] = "Parametros: " . $parametros . ", Error:" . $e;
				$datos['infoResponse'] = null;
			}
		}
		else
		{
			$datos['respuesta'] = 2;
			$datos['mensaje'] = "No se admiten datos nulos, verifique el envio de datos. Request = " . $pEmail . "-" . $pPassword;
		}

		echo json_encode($datos);		

	}
}
 ?>
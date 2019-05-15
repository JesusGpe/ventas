<?php 
class MetodosLogin
{ 
	function iniciarSesion($pEmail,$pPassword){

		$datos = array();
		$datosResponse = array();
		$datos['mensaje'] = "";
		$datos['mensajeWS'] = "";
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
				$datos['mensajeWS'] = "Servicio getUsuarioLoginWS, Parametros:". $parametros .", Fue Ejecutado Correctamente!.";
				

				$data = json_decode($datosResponse);
				$user = $data->respuesta;
				$_SESSION["id"] = $user->id;
				$_SESSION["nombre"] = $user->nombre;
				$_SESSION["apellido"] = $user->apellido;
				$_SESSION["email"] = $user->email;
				$_SESSION["password"] = $user->password;
				if ($user->id == 0) 
				{
					$datos['respuesta'] = 3;
					$datos['mensaje'] = "El Usuario o Contraseña es incorrecta";
				}
				else
				{
					 
					$datos['mensaje'] = "Bienvenido " . $user->nombre;
					$datos['respuesta'] = 1;
				}
			} 
			catch (Exception $e) 
			{
				$datos['respuesta'] = -1;
				$datos['mensajeWS'] = "Parametros: " . $parametros . ", Error:" . $e;
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
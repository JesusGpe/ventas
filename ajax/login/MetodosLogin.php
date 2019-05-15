<?php 
include("../php/CLog.php");

class MetodosLogin
{ 
	function iniciarSesion($pEmail,$pPassword){
		CLog::grabarlog(1, ":: 										::Ventas :: 										::");
		CLog::grabarlog(1, ":: Ventas :: Inicia Metodo -> iniciarSesion([$pEmail],[$pPassword]); ::");

		$datos = array();
		$datosResponse = array();
		$datos['mensaje'] = "";
		$datos['mensajeWS'] = "";
		$datos['respuesta'] = 0;
		$datos['infoResponse'];

		CLog::grabarlog(1, ':: Ventas :: Validacion -> if ([' . $pEmail . '] != "" && [ '. $pPassword . '] != "") ::');

		if ($pEmail != "" && $pPassword != "") 
		{

		$parametros = "email=" . $pEmail . "&password=" . $pPassword;
		$urlServicio = "http://10.44.150.211:8081/wsventas/getUsuarioLoginWS";
			try 
			{
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $urlServicio);

				CLog::grabarlog(1, ":: Ventas :: URL de servicio -> [$urlServicio] ::");

				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$parametros);

				CLog::grabarlog(1, ":: Ventas :: Parametros -> [$parametros] ::");

				if (curl_exec($ch)) 
				{
					CLog::grabarlog(1, ":: Ventas :: Servicio Ejecutado Correctamente ::");

					$datosResponse = curl_exec($ch);
					curl_close($ch); 

					CLog::grabarlog(1, ":: Ventas :: Response WS -> $datosResponse ::");

					$datos['infoResponse'] = json_decode($datosResponse);
					$datos['mensajeWS'] = "Servicio getUsuarioLoginWS, Parametros:[". $parametros ."], Fue Ejecutado Correctamente!.";
					//Se obtienen los datos de usuario para las variables de session
					$data = json_decode($datosResponse);
					$user = $data->respuesta;

					CLog::grabarlog(1, ':: Ventas :: Validacion -> if ([' . $user->nombre . ']  == null || [' . $user->nombre . ']  == "") ::');
					if ($user->nombre == null || $user->nombre == "") 
					{
						$datos['respuesta'] = 3;
						$datos['mensaje'] = "El Usuario o Contraseña es incorrecta";

						CLog::grabarlog(3, ':: Ventas :: [' . $datos["mensaje"] . '] ::');
					}
					else
					{
						 
						$_SESSION["id"] = $user->id;
						$_SESSION["nombre"] = $user->nombre;
						$_SESSION["apellido"] = $user->apellido;
						$_SESSION["email"] = $user->email;
						$_SESSION["password"] = $user->password;

						CLog::grabarlog(1, ":: Ventas :: Creacion De Variables De SESSION ::");

						$datos['mensaje'] = "Bienvenido " . $user->nombre;
						$datos['respuesta'] = 1;

						CLog::grabarlog(3, ':: Ventas :: [' . $datos["mensaje"] . '] ::');
					}
				}
				else
				{
					$datos['mensajeWS'] = "Error al ejecutar el Servicio getUsuarioLoginWS!.";
					$datos['respuesta'] = 4;
					$datos['mensaje'] = "Error de Conexion Con Web Service wsventas, Metodo -> getUsuarioLoginWS";

					CLog::grabarlog(2, ':: Ventas :: Mensaje del Servicio -> [' . $datos["mensajeWS"] . '] ::');
					CLog::grabarlog(2, ':: Ventas :: Mensaje Metodo iniciarSesion() -> [' . $datos["mensaje"] . '] ::');
				}
				
				

				
			} 
			catch (Exception $e) 
			{
				$datos['respuesta'] = -1;
				$datos['mensajeWS'] = "Parametros: " . $parametros . ", Error:" . $e;
				$datos['infoResponse'] = null;

				CLog::grabarlog(2, ':: Ventas :: Exception respuesta PHP -> [' . $datos["respuesta"] . '] ::');
				CLog::grabarlog(2, ':: Ventas :: Exception mensajeWS -> [' . $datos["mensajeWS"] . '] ::');
				CLog::grabarlog(2, ':: Ventas :: Exception mensaje PHP -> [' . $datos["mensaje"] . '] ::');
				CLog::grabarlog(2, ':: Ventas :: Exception infoResponse -> [' . $datos["infoResponse"] . '] ::');
			}
		}
		else
		{
			$datos['respuesta'] = 2;
			$datos['mensaje'] = "No se admiten datos nulos, verifique el envio de datos. Request = " . $pEmail . "-" . $pPassword;

			CLog::grabarlog(2, ':: Ventas :: else -> ['. $datos["respuesta"] . '] ::');
			CLog::grabarlog(2, ':: Ventas :: else -> [' . $datos["mensaje"] . '] ::');
		}

		CLog::grabarlog(1, ":: Ventas :: Finaliza Metodo -> iniciarSesion($pEmail,$pPassword); ::");
		CLog::grabarlog(1, ":: 										::Ventas :: 										::");

		echo json_encode($datos);		

	}
}
 ?>
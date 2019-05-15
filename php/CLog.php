<?php
	class CLog
	{
		
		public function grabarlog($tipo, $cadena)
		{
			date_default_timezone_set('UTC');
			$nombrearchivo = CLog::obtenerNombreArchivo();
			$dfecha = new DateTime("now");
			$ruta = "log/".$nombrearchivo;
			$etiqueta = '';
			if($tipo == 1)
			{
				$etiqueta = "[INFORMATIVO]";
			}
			else if($tipo == 2)
			{
				$etiqueta = "[ERROR]";
			}
			else if($tipo == 3)
			{
				$etiqueta = "[WARNING]";
			}
			$cad = "[".date_format($dfecha, 'Y-m-d H:i:s.'). "]$etiqueta.$cadena . \n";
			$file = fopen($ruta, "a");
			if( $file )
			{
				fputs($file,$cad);
			}
			
			fclose($file);
		}
		
		public function obtenerNombreArchivo()
		{
			$dfecha = new DateTime("now");
			$nombre = 'ventasProyect - '.$dfecha->format('Ymd').'.txt';
			return $nombre;
		}
	}

?>

<?php
include_once('Clases/Servicio.php');
$serv = New Servicio("comprimeAnita");
$zip = new ZipArchive();

if($serv->bloqueado){
	$serv->stop();
	if (!$serv->is_running()){exit;}		
}


while ($serv->is_running()){
	if (!file_exists(PATH_NOVEDADES_ENTRADA_ACUMULA)){
		$serv->pongo_hayError("No existe el directorio ".PATH_NOVEDADES_ENTRADA_ACUMULA);
	}
	if (!file_exists(PATH_BACKUP)){
		mkdir(PATH_BACKUP);
	}
		
	$ficheros=array();
	$serv->set_subestado("listando directorio...");
    $ficheros= scandir(PATH_NOVEDADES_ENTRADA_ACUMULA);
	$serv->set_subestado("zipeando paquetes...");
	$archivo_a_borrar=array();	
	
	foreach ($ficheros as $file){
		$serv->paquete=$file;		
		if($serv->is_running()){
			if(file_exists(PATH_NOVEDADES_ENTRADA_ACUMULA.$serv->paquete.".control")){	
				$fecha_paquete = substr($serv->paquete,0,6);   // obtengo la fecha del paquete
				if (!file_exists(PATH_BACKUP.$fecha_paquete)){
					mkdir(PATH_BACKUP.$fecha_paquete);
				}
				if($zip->open(PATH_BACKUP.$fecha_paquete."/mensajes.zip", ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE)===TRUE){
					$zip->addFile(PATH_NOVEDADES_ENTRADA_ACUMULA.$serv->paquete,$serv->paquete);
					array_push($archivo_a_borrar, PATH_NOVEDADES_ENTRADA_ACUMULA.$serv->paquete);
					$vuelta = $vuelta + 1;
					$serv->incrementar_secuencia();
					if($vuelta >= 1000 || !$serv->is_running()){
						$zip->close();			
						$vuelta = 0;
						foreach ($archivo_a_borrar as $archivo){
							if (!unlink($archivo)){
								$serv->pongo_hayError(error_get_last());
							}
						}
						unset($archivo_a_borrar);
						$archivo_a_borrar = array();
					}
				}
			}
		}else{
			foreach ($archivo_a_borrar as $archivo){
				if (!unlink($archivo)){
					$serv->pongo_hayError(error_get_last());
				}
			}
			break;
		}
	}
}






?>
<?php
sleep(2);
include_once('Clases/Servicio.php');
$serv = New Servicio("impoAnita");

if($serv->bloqueado){
	$serv->stop();
	if (!$serv->is_running()){exit;}		
}


while ($serv->is_running()){	
	$vuelta = 0;
	$ficheros=array();
	$serv->set_subestado("listando directorio...");
	if (!file_exists(PATH_NOVEDADES_ENTRADA)){$serv->pongo_hayError("NO EXISTEN Ó NO ESTA CONECTADA ".PATH_NOVEDADES_ENTRADA); exit; }
	
	$ficheros= scandir(PATH_NOVEDADES_ENTRADA);
	$serv->set_subestado("tratando paquetes...");

	foreach ($ficheros as $file){
		$serv->paquete = $file;                        
		if ($serv->is_running()){
			if ($serv->tiene_punto_control()){                      
				$nro_paq = substr($serv->paquete,15,6);    // obtengo el nro de paquete
				$nro_seq = $serv->get_secuencia();         // obtengo el numero esperado
				if ($nro_seq==$nro_paq){
					$serv->trato_paquete();
					$vuelta = 0;
				}elseif($nro_paq < $nro_seq){
						$serv->mensaje = "error en secuencia ".$paq_dat."  nro secuencia ".$nro_seq;
						$serv->pongo_secue();
						$vuelta = 0;
					}else{
					/*	$serv->secuencia=$nro_paq;
						$serv->save();break;*/
						$vuelta = $vuelta + 1;
						sleep(1);
						if ($vuelta > 10){
							$serv->mensaje = "falta paquete ".$nro_seq;
							$vuelta = 0;
							$serv->paquete = "";
							$serv->pongo_secue();
		//					$serv->incrementar_secuencia();
						} 
					
					}
			}
		}else{
				break;
			}
		}
		unset($ficheros);
		
	}


?>
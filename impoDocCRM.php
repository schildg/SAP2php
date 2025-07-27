<?php
include_once('Clases/Servicio.php');
$serv = New Servicio("impoDocCRM");

if($serv->bloqueado){
	$serv->stop();
	if (!$serv->is_running()){exit;}		
}


include_once ("Clases/Almacen.php");
include_once ("Clases/Centro.php");
include_once ("Clases/Existencia_Material.php");
include_once ("Clases/Cabecera_Factura.php");
include_once ("Clases/Material.php");
include_once ("Clases/Cliente_CRM_TODO.php");
include_once ("Clases/Cheques.php");
include_once ("Clases/Cheques_CRM_TODO.php");
include_once ("Clases/Cabecera_Contabilidad.php");
include_once ("Clases/Linea_Contabilidad.php");
include_once ("Clases/Condicion_Pago.php");
include_once ("Clases/Deuda_CRM_TODO.php");
include_once ("Clases/Recibo_CRM.php");
include_once ("Clases/Deuda_CRM.php");
include_once ("Clases/Deuda_CRM_TMP.php");
include_once ("Clases/Actualizacion_CRM.php");
include_once ("Clases/saprfc.php");
include_once ("funciones.php");
$tiempo_en_seg = 2;//60*0.5;

$vuelta=0;


while ($serv->is_running()){
	$timestamp = mktime(0, 0, 0,  date("m"), date("d"), date("Y")) - ( 5 * 60 * 60 * 24); //Menos 5 DIAS
	$fecha_inicio = date("Ymd",$timestamp);
	$timestamp1 = mktime(0, 0, 0,  date("m"), date("d"), date("Y")) + ( 1 * 60 * 60 * 24); //MAS 2 DIAS
	$fecha_fin    =  date("Ymd",$timestamp1);
	
    		
	$serv->set_subestado("llamando funcion");
	$login = array (
			"ASHOST"=>SAPRFC_ASHOST,
			"SYSNR"=>SAPRFC_SYSNR,
			"CLIENT"=>SAPRFC_CLIENT,
			"USER"=>SAPRFC_USER,
			"PASSWD"=>SAPRFC_PASSWD,
			"CODEPAGE"=>SAPRFC_CODEPAGE
	        );
	$rfc = saprfc_open ($login );
	if (!$rfc ) { $serv->pongo_hayError("RFC connection failed"); exit; }

	$vuelta=$vuelta+1;
	switch ($vuelta) {
//		case 1: include ('bd_backup.php');break;
		case 2:	
		        $serv->set_subestado("borrando logs resultado_ejecucion");
				$sql_ok = true; 
				$sql = "DELETE FROM `resultado_ejecucion` WHERE `date_concurrency` < (now() - interval 2 day)";       //Borro logs
				try {
					MyActiveRecord :: Query($sql);
				} catch (Exception $e) {
					$sql_ok = false;
				}
				break;   
		case 3: $vuelta = 0;	
		        $serv->set_subestado("proceso terminado exitosamente");
				$serv->stop();
	}
	
	//	saprfc_function_debug_info($fce);
	$serv->set_subestado("liberando/cerrando conexion");
	saprfc_close($rfc);
/*	for($i=0;$i<=$tiempo_en_seg;$i++){
		if ($serv->is_running()){
			$serv->set_subestado("el ciclo se inicia en ".(($tiempo_en_seg)-$i)." segundos");
			sleep(1); //espera $tiempo_en_seg minutos
		}else{
			break;
		}
	}
*/	
}

?>
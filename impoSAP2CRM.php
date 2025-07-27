<?php
date_default_timezone_set('America/Argentina/Buenos_Aires'); 
include_once('Clases/Servicio.php');
$serv = New Servicio("impoSAP2CRM");

if($serv->bloqueado){
	$serv->stop();
	if (!$serv->is_running()){exit;}		
}

include_once ("Clases/Material.php");
include_once ("Clases/Condicion_Pago.php");
include_once ("Clases/Cliente_CRM_TODO.php");
include_once ("Clases/Cheques.php");
include_once ("Clases/Cheques_CRM_TODO.php");
include_once ("Clases/Deuda_CRM_TODO.php");
include_once ("Clases/Recibo_CRM.php");
include_once ("Clases/Actualizacion_CRM.php");
//include_once ("Clases/Deuda_CRM.php");
include_once ("Clases/Deuda_CRM_TMP.php");
include_once ("Clases/Venta_CRM_TMP.php");
include_once ("Clases/saprfc.php");
include_once ("Clases/Cobranza_CRM_TMP.php");
include_once ("funciones.php");

$tiempo_en_seg = 2;//60*0.5;

$vuelta=0;



$timestamp = mktime(0, 0, 0, date("m"),'01',date("Y"));
$fecha_inicio = date("Ymd",$timestamp);
$ultimo=getUltimoDiaMes(date("Y",$timestamp), date("m",$timestamp));
$timestamp = mktime(0, 0, 0,date("m",$timestamp),$ultimo,date("Y",$timestamp)); 
$fecha_fin = date("Ymd",$timestamp);

$timestamp = mktime(0, 0, 0, date("m"),'10',date("Y"));
$fecha_al_10 = date("Ymd",$timestamp);
$timestamp = mktime(0, 0, 0, date("m"),'20',date("Y"));
$fecha_al_20 = date("Ymd",$timestamp);


while ($serv->is_running()){
		
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
		case 1: include("impo_venta2_crm.php");break;
		case 2: include("impo_Cheques.php");break;
/*		case 3: $fecha_ini_cobranza=$fecha_inicio;
		        $fecha_fin_cobranza=$fecha_al_10;
				include("impo_cobranza5.php");break;
			    $fecha_ini_cobranza=$fecha_al_10;
		        $fecha_fin_cobranza=$fecha_al_20;
				include("impo_cobranza5.php");break;
			    $fecha_ini_cobranza=$fecha_al_20;*/
		case 3: $fecha_ini_cobranza=$fecha_inicio;
			    $fecha_fin_cobranza=$fecha_fin;
				include("impo_cobranza5.php");break;
				
		case 4: include("impo_Deuda_CRM.php");
			include("armo_Cliente_CRM.php");
			$serv->set_subestado("proceso terminado exitosamente");
			$serv->stop();
		break;  //cargo datos
	}
	
	//	saprfc_function_debug_info($fce);
	$serv->set_subestado("liberando/cerrando conexion");
	saprfc_close($rfc);
	for($i=0;$i<=$tiempo_en_seg;$i++){
		if ($serv->is_running()){
			$serv->set_subestado("el ciclo se inicia en ".(($tiempo_en_seg)-$i)." segundos");
			sleep(1); //espera $tiempo_en_seg minutos
		}else{
			break;
		}
	}
	
}

?>
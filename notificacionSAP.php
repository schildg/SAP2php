<?php
sleep(2);
include_once('Clases/Servicio.php');
$serv = New Servicio("notificacionSAP");

if($serv->bloqueado){
	$serv->stop();
	if (!$serv->is_running()){exit;}		
}


include_once ("Clases/Out_ProdOrdConf_Create_TT.php");
include_once ("Clases/Resultado_Ejecucion.php");
include_once ("Clases/Out_OrdFab_Consumo.php");
include_once ("Clases/Out_EmHu_OrdFab.php");
include_once ("Clases/Pendiente_Tratar.php");
include_once ("Clases/OrdenProduccion.php");
include_once ("Clases/Out_GoodsMvment.php");
include_once ("Clases/Componente.php");
include_once ("Clases/Operacion.php");
include_once ("Clases/Posicion.php");
include_once ("Clases/Material.php");
include_once ("Clases/saprfc.php");
include_once ("Clases/Px_Pfp.php");
include_once ("Clases/Ns_Rel.php");
include_once ("Clases/St_Doc.php");
include_once ("Clases/St_Lar.php");
include_once ("Clases/St_Rld.php");
include_once ("Clases/Sl_Tar.php");
include_once ("Clases/St_Lot.php");
include_once ("Clases/Ut_Hu.php");
include_once ("funciones.php");

$tiempo=60*0.5;
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

//	include ("PARTICION_ORDFAB.php"); // Hago tratamiento de ZRFCPP_PARTICION_ORDFAB
//	include ("CONSUMO_ORDFAB.php"); // Hago tratamiento de ZRFCPP_CONSUMO_ORDFAB
	include ("PRODORDCONF_CREATE_TT.php"); // Hago tratamiento de BAPI_PRODORDCONF_CREATE_TT
	include ("QUE_RFC_HUMAT.php"); // Hago control de consumos e ingresos, mediante consulta de consumos
	include ("PRODORD_COMPLETE_TECH.php"); // Hago cierre tecnico mediante BAPI_PRODORD_COMPLETE_TECH
	
	
	//	saprfc_function_debug_info($fce);
	$serv->set_subestado("liberando/cerrando conexion");
	saprfc_close($rfc);
	for($i=0;$i<=$tiempo;$i++){
		if ($serv->is_running()){
			$serv->set_subestado("el ciclo se inicia en ".(($tiempo)-$i)." segundos");
			sleep(1); //espera 1 segundo
		}else{
			break;
		}
	}
	
}

?>
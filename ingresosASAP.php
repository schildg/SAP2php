<?php
sleep(2);
include_once('Clases/Servicio.php');
$serv = New Servicio("ingresosASAP");

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
include_once ("Clases/At_Mov.php");
include_once ("funciones.php");


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
	$serv->set_subestado("llamando PRODORD_CHANGE");
	include ("PRODORD_CHANGE.php"); // Hago tratamiento de BAPI_PRODORD_CHANGE // cambio datos de las ordenes de fabricacion
	$serv->set_subestado("llamando BATCH_CHANGE");
	include ("BATCH_CHANGE.php"); // Hago tratamiento de BAPI_BATCH_CHANGE // cambio datos de los datos fijos del lote
	$serv->set_subestado("llamando EMHU_ORDFAB");
	include ("EMHU_ORDFAB.php"); // Hago tratamiento de ZRFCPP_EMHU_ORDFAB // genero el ingreso de la mercaderia
	$serv->set_subestado("llamando ETIQUETA_HU_ZPL_RFC");
	include ("ETIQUETA_HU_ZPL_RFC.php"); // genero la impresion de las etiquetas 
	$serv->set_subestado("llamando HU_CREATE_GOODMVT_309");
	include ("HU_CREATE_GOODMVT_309.php"); // genero la impresion de las etiquetas 
	
	
	//	saprfc_function_debug_info($fce);
	$serv->set_subestado("liberando/cerrando conexion");
	saprfc_close($rfc);
	for($i=0;$i<=60*1;$i++){
		if ($serv->is_running()){
			$serv->set_subestado("el ciclo se inicia en ".((60*1)-$i)." segundos");
			sleep(1); //espera 10 minutos
		}else{
			break;
		}
	}
	
}

?>
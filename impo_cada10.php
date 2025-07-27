<?php
include_once('Clases/Servicio.php');
$serv = New Servicio("impo_cada10");

if($serv->bloqueado){
	$serv->stop();
	if (!$serv->is_running()){exit;}		
}

include_once ("Clases/Almacen.php");
include_once ("Clases/Centro.php");
//include_once ("Clases/Existencia_Material.php");
include_once ("Clases/Material.php");
include_once ("Clases/Cliente_CRM_TODO.php");
//include_once ("Clases/Cheques.php");
include_once ("Clases/Condicion_Pago.php");
include_once ("Clases/Deuda_CRM_TODO.php");
//include_once ("Clases/Recibo_CRM.php");
include_once ("Clases/Actualizacion_CRM.php");
include_once ("Clases/Estruc_TrasabCob.php");
//include_once ("Clases/Venta_CRM.php");
//include_once ("Clases/Deuda_CRM.php");
include_once ("Clases/Deuda_CRM_TMP.php");
//include_once ("Clases/Stock_CRM.php");
include_once ("Clases/Stock_CRM_tmp.php");
include_once ("Clases/PPendientes_CRM_TODO.php");
include_once ("Clases/PPendientes_CRM_TMP.php");
include_once ("Clases/CPendientes_CRM_TMP.php");
include_once ("Clases/Flujo_CRM_TMP.php");
include_once ("Clases/Costo_CRM_TMP.php");
include_once ("Clases/Actu_Flujo_CRM.php");
include_once ("Clases/saprfc.php");
include_once ("funciones.php");

$tiempo_en_seg = 2;//60*0.5;

$vuelta=0;



$reg_ult_act = new Actualizacion_CRM("Fecha_cada10");
$str_fecha=$reg_ult_act->Ultima_Actualizacion;

$timestamp = mktime(0, 0, 0,  date("m"), date("d"), date("Y"));
$fecha_HOY = date("Ymd",$timestamp);
if($fecha_HOY > $str_fecha){
	$str_anio=substr($str_fecha,0,4);
	$str_mes=substr($str_fecha,4,2);
	$str_dia=substr($str_fecha,6,2);
	$str_fecha=$str_anio.$str_mes.$str_dia;
	
	$timestamp = mktime(0, 0, 0,  $str_mes,'01',$str_anio);
	$fecha_inicio = date("Ymd",$timestamp);
	$ultimo=getUltimoDiaMes(date("Y",$timestamp), date("m",$timestamp));
	$timestamp = mktime(0, 0, 0,date("m",$timestamp),$ultimo,date("Y",$timestamp)); 
	$fecha_fin = date("Ymd",$timestamp);


	echo "fecha inicio:".$fecha_inicio." fecha fin:".$fecha_fin."  Fech BD:".$reg_ult_act->Ultima_Actualizacion."\r\n";
	
	$reg_ult_act = new Actualizacion_CRM("Fecha_cada10");
	$reg_ult_act->Ultima_Actualizacion=$fecha_HOY;
	$reg_ult_act->save();

}else{
	$timestamp = mktime(0, 0, 0,  date("m"), date("d"), date("Y")) - ( 2 * 60 * 60 * 24); //Menos 5 DIAS
	$fecha_inicio = date("Ymd",$timestamp);
	$timestamp1 = mktime(0, 0, 0,  date("m"), date("d"), date("Y")) + ( 1 * 60 * 60 * 24); //MAS 2 DIAS
	$fecha_fin    =  date("Ymd",$timestamp1);

}


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
	
	include("impo_Stock_CRM.php");
	include("impo_ppendiente_crm.php");
	include("impo_cpendiente_crm.php");
	//include("impo_flujo_crm.php");
	include("impo_costo_crm.php");
	
	$serv->set_subestado("liberando/cerrando conexion");
	saprfc_close($rfc);
	$serv->stop();
}

?>
<?php
include_once('Clases/Servicio.php');
$serv = New Servicio("impoMaestrosCRM");

if($serv->bloqueado){
	$serv->stop();
	if (!$serv->is_running()){exit;}		
}



include_once ("Clases/Almacen.php");
include_once ("Clases/Grupo_Articulo.php");
include_once ("Clases/Centro.php");
include_once ("Clases/Existencia_Material.php");
include_once ("Clases/Material.php");
include_once ("Clases/Cliente_CRM_TODO.php");
include_once ("Clases/Cheques.php");
include_once ("Clases/Condicion_Pago.php");
include_once ("Clases/Deuda_CRM_TODO.php");
include_once ("Clases/Recibo_CRM.php");
include_once ("Clases/Actualizacion_CRM.php");
include_once ("Clases/Venta_CRM_TMP.php");
include_once ("Clases/Costo_CRM_TMP.php");
include_once ("Clases/Vendedor_CRM_TMP.php");
include_once ("Clases/PPendientes_CRM_TODO.php");
include_once ("Clases/PPendientes_CRM_TMP.php");
include_once ("Clases/CPendientes_CRM_TODO.php");
include_once ("Clases/CPendientes_CRM_TMP.php");
include_once ("Clases/saprfc.php");
include_once ("funciones.php");
$tiempo_en_seg = 2;//60*0.5;

$vuelta=0;

while ($serv->is_running()){
	$timestamp = mktime(0, 0, 0,  date("m"), date("d"), date("Y")) - ( 5 * 60 * 60 * 24); //Menos 5 DIAS
	$fecha_inicio = date("Ymd",$timestamp);
	$timestamp1 = mktime(0, 0, 0,  date("m"), date("d"), date("Y")) + ( 2 * 60 * 60 * 24); //MAS 2 DIAS
	$fecha_fin    =  date("Ymd",$timestamp1);
	$timestampc = mktime(0, 0, 0,  date("m"), date("d"), date("Y")) - ( 1 * 60 * 60 * 24); //un dia menos para el calculo del costo
	$fecha_calc_costo    =  date("Ymd",$timestampc);
	
	$serv->set_subestado("llamando funcion");
	$login = array (
			"ASHOST"=>SAPRFC_ASHOST,
			"SYSNR"=>SAPRFC_SYSNR,
			"CLIENT"=>SAPRFC_CLIENT,
			"USER"=>SAPRFC_USER,
			"PASSWD"=>SAPRFC_PASSWD,
			"LANG"=>SAPRFC_LANG,
			"CODEPAGE"=>SAPRFC_CODEPAGE
	        );
	$rfc = saprfc_open ($login );
	if (!$rfc ) { $serv->pongo_hayError("RFC connection failed"); exit; }

	$vuelta=$vuelta+1;
	switch ($vuelta) {
		case 1:	include("impo_Condicion_Pago.php"); break; //importo la condicion de pago
		case 2:	include("impo_Grupo_Articulo.php"); break; //importo los textos de los grupos de articulos
		case 3: include("impo_Cliente_CRM.php"); break;  //importo clientes y sus textos por sociedad
		case 4:	include("impo_Almacen.php"); break; //importo la condicion de pago
		case 5:	include("impo_Centro.php"); break; //importo la condicion de pago
		case 6: include("impo_producto.php");break;
		//case 7: include("impo_cpendiente_crm.php");break;
		//case 8: include("impo_ppendiente_crm.php");break;
		//		case 6: include("impo_venta2_crm.php");break;
		//include("impo_Existencia_Material.php"); break;  //importo la existencia de materiales, materiales y sus textoa
		//case 9: include("impo_costo_crm.php"); break;  //importo costos de los materiales
		
		case 10: $vuelta = 0;	$serv->stop();
			
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
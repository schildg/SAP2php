<?php
sleep(2);
include_once('Clases/Servicio.php');
$serv = New Servicio("impoSAP");

if($serv->bloqueado){
	$serv->stop();
	if (!$serv->is_running()){exit;}		
}

include_once ("Clases/ListaMovimientoMateriales.php");
include_once ("Clases/CabeceraMovimientoMaterial.php");
include_once ("Clases/LineaMovimientoMaterial.php");
include_once ("Clases/LoteMovimientoMaterial.php");
include_once ("Clases/HUMovimientoMaterial.php");
include_once ("Clases/Clase_Movimiento.php");
include_once ("Clases/OrdenProduccion.php");
include_once ("Clases/Componente.php");
include_once ("Clases/Operacion.php");
include_once ("Clases/Posicion.php");
include_once ("Clases/Material.php");
include_once ("Clases/Ns_Rel.php");
include_once ("Clases/saprfc.php");
include_once ("funciones.php");
$tiempo=60* 1; //1 minutos


while ($serv->is_running()){
	$timestamp = mktime(0, 0, 0,  date("m"), date("d"), date("Y")) - ( 4 * 60 * 60 * 24); //Menos 1 DIAS
	$fecha_inicio = date("Ymd",$timestamp);
	//$timestamp1 = mktime(0, 0, 0,  date("m"), date("d"), date("Y")) + ( 20 * 60 * 60 * 24); //MAS 6 DIAS
	$timestamp1 = mktime(0, 0, 0,  date("m"), date("d"), date("Y")) + ( 220 * 60 * 60 * 24); //MAS 6 DIAS
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
	
	include("envio_Ut_Hu.php"); // Hago tratamiento de Ut con HU SAP
	include("envio_At_Mov.php"); // Hago tratamiento de Movimientos de ingresos de mercadeiras
	include("DOCMAT_HU.php"); // Hago tratamiento de ZRCPP_DOCMAT_HU
	include("DOCMAT_HU_para_analisis.php"); // Hago tratamiento de ZRCPP_DOCMAT_HU para analisis
	include("DOCMAT_HU_merinos.php"); // Hago tratamiento de ZRCPP_DOCMAT_HU para analisis de los merinos de fabricados
	include("DOCMAT_HU_ingresos_merinos.php"); // Hago tratamiento de ZRCPP_DOCMAT_HU para analisis de los ingresos en merinos
	include("ORDFAB.php"); // Hago tratamiento de ZRCPP_ORDFAB
//$serv->stop();
	
	//	saprfc_function_debug_info($fce);
	$serv->set_subestado("liberando/cerrando conexion");
	saprfc_close($rfc);
	for($i=0;$i<=$tiempo;$i++){
		if ($serv->is_running()){
			$serv->set_subestado("el ciclo se inicia en ".(($tiempo)-$i)." segundos");
			sleep(1); //espera 10 minutos
		}else{
			break;
		}
	}
	
}

?>
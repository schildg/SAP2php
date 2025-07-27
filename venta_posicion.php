<?php

/**********************************
*
* Para el período actual (año-mes) calcula la posición de venta (venta - pedidos pendientes)para:
* 1- País ; 2- UN ; 3- Presupuestos cargados
* Creado Agosto 2016
*
***********************************/
include_once('Clases/Servicio.php');
$serv = New Servicio("testing");

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


/*
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

*/

//           ->>>>>>>>>>>> while ($serv->is_running()){
/*	
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
	*/
	
/*	include("impo_Stock_CRM.php");
	include("impo_ppendiente_crm.php");
	include("impo_cpendiente_crm.php");
	include("impo_flujo_crm.php");
	include("impo_costo_crm.php");
	*/ 
	
/**********************************************
 * POSICION DE VENTA (idem ve-pglo) creador 8/8/2016
 * calcula para cada sociedad , UN y vendedor:
 *       --- Total de Venta
 *       --- Total de Pedidos Pendientes
 *       --- Presupuesto
***********************************************/

$periodo = date("Y").date("m"); // tomo periodo actual formato 201608 por ejemplo para levantar los datos

$serv->set_subestado("borro datos de Posicion de Ventas");

$sql_ok = true; 
$sql = "TRUNCATE TABLE `venta_posicion`";       //borro toda la posición de Ventas.
try {
	MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$serv->pongo_hayError($sql."||".$e);
	$sql_ok = false;
	
}

/***************************************************************************************************
 *                          AR20
 
		// $sql = "INSERT IGNORE INTO STOCK_CRM_TODO (BUKRS,WERKS,LGORT,MATNR) SELECT BUKRS,WERKS,LGORT,MATNR FROM stock_crm_tmp AS P WHERE LGORT!='' AND WERKS!='' AND MATNR!='' GROUP BY BUKRS,WERKS,LGORT,MATNR";       //nuevo stock
 
 "INSERT IGNORE INTO VENTA_POSICION (tipo, orden, clasificacion, periodo, fechainicio, fechafin, sociedad, organizacionventas, linea, vendedor, cliente, material, cantidad, importe, costo, renta, rentap, actualizado)
				  SELECT 1,1, 'Venta Facturada', '201608' , '20160801' as fechainicio, '20160831' as fechafin, 'AR20' as sociedad, '' as organizacionventas, '' as linea , '' as vendedor, '' as cliente, '' as material, SUM(ZMENG) as cantidad, SUM(NETPR_USD) as importe, SUM(WAVWR_USD) as costo, (`sap2php`.`venta_crm_todo`.`NETPR_USD` - `sap2php`.`venta_crm_todo`.`WAVWR_USD`) AS renta, (`sap2php`.`venta_crm_todo`.`NETPR_USD` = 0),-(100),((`sap2php`.`venta_crm_todo`.`WAVWR_USD` / `sap2php`.`venta_crm_todo`.`NETPR_USD`) * 100)) as decimal(10,2)) AS `rentap`, FECHAACTUALIZACION
				   FROM  venta_crm_todo where WHERE BUKRS = 'AR20' AND ERDAT like '201608%'";
				
 ***************************************************************************************************/
// Calculo la posición de venta para AR20

$serv->set_subestado("Iniciando proceso Posicion de Venta AR20");
	$sql = "START TRANSACTION";
	try {
		MyActiveRecord :: Query($sql);
		$sql = "INSERT IGNORE INTO VENTA_POSICION 
				  (CRM_ID, tipo, orden, clasificacion, periodo, fechainicio, fechafin, sociedad, organizacionventas, linea, vendedor, cliente, material, cantidad, importe, costo, renta, rentap, actualizado) 
				  SELECT concat('$periodo','AR20'),1,1, 'Venta Facturada', '$periodo' , '20160801', '20160831', 'AR20', '', '', '', '', '', SUM(ZMENG), SUM(NETPR_USD), SUM(WAVWR_USD), (NETPR_USD - WAVWR_USD), (WAVWR_USD/NETPR_USD*100), now() 
				  FROM venta_crm_todo where BUKRS = 'AR20' AND ERDAT like '$periodo%'"; 
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
	   $sql_ok = true; 
		$sql = "COMMIT";     
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
	} catch (Exception $e) {
		$sql = "ROLLBACK";  
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			$serv->pongo_hayError($sql."||".$e);
		}
		
	}	
				
// Calculo la posición de venta para AR20 --> FEED				
				
								
$serv->set_subestado("Posicion de Venta AR20 (Feed)");
	$sql = "START TRANSACTION";
		MyActiveRecord :: Query($sql);
	try {
		$sql = "INSERT IGNORE INTO VENTA_POSICION 
				  (CRM_ID, tipo, orden, clasificacion, periodo, fechainicio, fechafin, sociedad, organizacionventas, linea, vendedor, cliente, material, cantidad, importe, costo, renta, rentap, actualizado) 
				  SELECT concat('$periodo','AR20','2010'),1,1, 'Venta Facturada', '$periodo' , '20160801', '20160831', 'AR20', '2010', '', '', '', '', SUM(ZMENG), SUM(NETPR_USD), SUM(WAVWR_USD), (NETPR_USD - WAVWR_USD), (WAVWR_USD/NETPR_USD*100), now() 
				  FROM venta_crm_todo where BUKRS = 'AR20' AND VKORG = '2010' AND ERDAT like '$periodo%'"; 
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
	   $sql_ok = true; 
		$sql = "COMMIT";     
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
	} catch (Exception $e) {
		$sql = "ROLLBACK";  
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			$serv->pongo_hayError($sql."||".$e);
		}
		
	}	

	// Calculo la posición de venta para AR20 --> FOOD				
				
								
$serv->set_subestado("Posicion de Venta AR20 (Food)");
	$sql = "START TRANSACTION";
		MyActiveRecord :: Query($sql);
	try {
		$sql = "INSERT IGNORE INTO VENTA_POSICION 
				  (CRM_ID, tipo, orden, clasificacion, periodo, fechainicio, fechafin, sociedad, organizacionventas, linea, vendedor, cliente, material, cantidad, importe, costo, renta, rentap, actualizado) 
				  SELECT concat('$periodo','AR20','2020'),1,1, 'Venta Facturada', '$periodo' , '20160801', '20160831', 'AR20', '2020', '', '', '', '', SUM(ZMENG), SUM(NETPR_USD), SUM(WAVWR_USD), (NETPR_USD - WAVWR_USD), (WAVWR_USD/NETPR_USD*100), now() 
				  FROM venta_crm_todo where BUKRS = 'AR20' AND VKORG = '2020' AND ERDAT like '$periodo%'"; 
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
	   $sql_ok = true; 
		$sql = "COMMIT";     
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
	} catch (Exception $e) {
		$sql = "ROLLBACK";  
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			$serv->pongo_hayError($sql."||".$e);
		}
		
	}	

	
	
	// Calculo la posición de venta para AR20 --> INDUSTRIAL
				
								
$serv->set_subestado("Posicion de Venta AR20 (INDUSTRIAL)");
	$sql = "START TRANSACTION";
		MyActiveRecord :: Query($sql);
	try {
		$sql = "INSERT IGNORE INTO VENTA_POSICION 
				  (CRM_ID, tipo, orden, clasificacion, periodo, fechainicio, fechafin, sociedad, organizacionventas, linea, vendedor, cliente, material, cantidad, importe, costo, renta, rentap, actualizado) 
				  SELECT concat('$periodo','AR20','2030'),1,1, 'Venta Facturada', '$periodo' , '20160801', '20160831', 'AR20', '2030', '', '', '', '', SUM(ZMENG), SUM(NETPR_USD), SUM(WAVWR_USD), (NETPR_USD - WAVWR_USD), (WAVWR_USD/NETPR_USD*100), now() 
				  FROM venta_crm_todo where BUKRS = 'AR20' AND VKORG = '2030' AND ERDAT like '$periodo%'"; 
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
	   $sql_ok = true; 
		$sql = "COMMIT";     
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
	} catch (Exception $e) {
		$sql = "ROLLBACK";  
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			$serv->pongo_hayError($sql."||".$e);
		}
		
	}	

	
	
	
		
	//           ->>>>>>>>>>>> este es del while !! }	
	
	

/***************************************************************************************************
 *                          PE10
 ***************************************************************************************************/

$serv->set_subestado("Iniciando proceso Posicion de Venta PE10");
	$sql = "START TRANSACTION";
	try {
		MyActiveRecord :: Query($sql);
		$sql = "INSERT IGNORE INTO VENTA_POSICION 
				  (CRM_ID,tipo, orden, clasificacion, periodo, fechainicio, fechafin, sociedad, organizacionventas, linea, vendedor, cliente, material, cantidad, importe, costo, renta, rentap, actualizado) 
				  SELECT concat('$periodo','PE10'), 1,1, 'Venta Facturada', '$periodo' , '20160801', '20160831', 'PE10', '', '', '', '', '', SUM(ZMENG), SUM(NETPR_USD), SUM(WAVWR_USD), SUM(NETPR_USD - WAVWR_USD), AVG(WAVWR_USD/NETPR_USD*100), now() 
				  FROM venta_crm_todo where BUKRS = 'PE10' AND ERDAT like '$periodo%'"; 
				  
		try 
		{
			MyActiveRecord :: Query($sql);
		} 
			catch (Exception $e) 
		{
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
 	    $sql_ok = true; 
		$sql = "COMMIT";     
		try 
		{
			MyActiveRecord :: Query($sql);
		} 
			catch (Exception $e) 
		{
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
	} catch (Exception $e) {
		$sql = "ROLLBACK";  
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			$serv->pongo_hayError($sql."||".$e);
		}
		
	}	



/***************************************************************************************************
 *                          
 ***************************************************************************************************/
	
	$serv->set_subestado("liberando/cerrando conexion");
	// saprfc_close($rfc);
	$serv->stop();



/*

	1	id	int(10)		UNSIGNED	No 	Ninguna	AUTO_INCREMENT	Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Más

	2	tipo	int(10)		UNSIGNED	No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Más

	3	orden	int(10)		UNSIGNED	No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Más

	4	clasificacion	varchar(30)	latin1_general_ci		No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Más

	5	periodo	varchar(6)	latin1_general_ci		No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Más

	6	fechainicio	varchar(8)	latin1_general_ci		No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Más

	7	fechafin	varchar(8)	latin1_general_ci		No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Más

	8	sociedad	varchar(4)	latin1_general_ci		No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Más

	9	organizacionventas	varchar(4)	latin1_general_ci		No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Más

	10	linea	varchar(30)	latin1_general_ci		No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Más

	11	vendedor	varchar(10)	latin1_general_ci		No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Más

	12	cliente	varchar(10)	latin1_general_ci		No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Más

	13	material	varchar(18)	latin1_general_ci		No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Más

	14	cantidad	decimal(13,2)			No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Más

	15	importe	decimal(13,2)			No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Más

	16	costo	decimal(13,2)			No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Más

	17	renta	decimal(13,2)			No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Más

	18	rentap	decimal(13,2)			No 	Ninguna		Cambiar Cambiar	Eliminar Eliminar	

    Primaria Primaria
    Más

	19	actualizado


		cast(if(		  

 SELECT BUKRS,WERKS,LGORT,MATNR FROM stock_crm_tmp AS P WHERE LGORT!='' AND WERKS!='' AND MATNR!='' GROUP BY BUKRS,WERKS,LGORT,MATNR";       //nuevo stock


*/	




?>
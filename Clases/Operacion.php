<?php
include_once('DATA_CONF.php');
include_once('OrdenProduccion.php');
class Operacion extends SuperClase{
	function Operacion() {
		$this->CLASE_OBJETO='Operacion';
	}
	function buscarExtendido($vord_nmbr,$voper_number) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"AUFNR = '$vord_nmbr' AND OPERATION_NUMBER = '$voper_number'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	function existe($vord_nmbr,$voper_number) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"AUFNR = '$vord_nmbr' AND OPERATION_NUMBER = '$voper_number'");
		if (!$rela){
			return false;
		}else{
			return true;
		};
		
	}
	
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","AUFNR" => "Número de orden","ROUTING_NO" => "Nº hoja ruta de operaciones en orden","COUNTER" => "Contador general de la orden","SEQUENCE_NO" => "Secuencia","CONF_NO" => "Número de notificación de la operación","CONF_CNT" => "Contador de notificación","PURCHASE_REQ_NO" => "Número de solicitud de pedido","PURCHASE_REQ_ITEM" => "Número de posición de la socitud de pedido en la o","GROUP_COUNTER" => "Contador grupo hojas ruta","TASK_LIST_TYPE" => "Tipo de hoja de ruta","TASK_LIST_GROUP" => "Clave de grupo hojas de ruta","OPERATION_NUMBER" => "Número de operación","OPR_CNTRL_KEY" => "Clave de control","PROD_PLANT" => "Centro","DESCRIPTION" => "Texto breve operación","DESCRIPTION2" => "Descripción operación: 2. línea de texto","STANDARD_VALUE_KEY" => "Clave de valor prefijado","ACTIVITY_TYPE_1" => "Clase de actividad","ACTIVITY_TYPE_2" => "Clase de actividad","ACTIVITY_TYPE_3" => "Clase de actividad","ACTIVITY_TYPE_4" => "Clase de actividad","ACTIVITY_TYPE_5" => "Clase de actividad","ACTIVITY_TYPE_6" => "Clase de actividad","UNIT" => "Unidad de medida de la operación","UNIT_ISO" => "Código ISO p.unidad de medida","QUANTITY" => "Cantidad de operación","SCRAP" => "Cantidad de rechazo de la operación","EARL_SCHED_START_DATE_EXEC" => "Inicio más temprano pogramado: Ejecución  (Fecha)","EARL_SCHED_START_TIME_EXEC" => "Inicio más temprano programado: Ejecución (Hora)","EARL_SCHED_START_DATE_PROC" => "Inicio más temprano programado: Tratar (fecha)","EARL_SCHED_START_TIME_PROC" => "Inicio más temprano programado: tratar (hora)","EARL_SCHED_START_DATE_TEARD" => "Inicio más temprano programado: Desmontar (fecha)","EARL_SCHED_START_TIME_TEARD" => "Inicio más temprano programado: Desmontar (hora)","EARL_SCHED_FIN_DATE_EXEC" => "Fin más temprano programado: Ejecución (Fecha)","EARL_SCHED_FIN_TIME_EXEC" => "Fin más temprano programado: Ejecutar (hora)","LATE_SCHED_START_DATE_EXEC" => "Inicio programado más tardío: Efectuar (fecha)","LATE_SCHED_START_TIME_EXEC" => "Inicio más tardío programado: Efectuar (Hora)","LATE_SCHED_START_DATE_PROC" => "Inicio más tardío programado: Tratar (fecha)","LATE_SCHED_START_TIME_PROC" => "Inicio más tardío programado: Tratar (hora)","LATE_SCHED_START_DATE_TEARD" => "Inicio más tardío programado: Desmontar (Fecha)","LATE_SCHED_START_TIME_TEARD" => "Inicio más tardío programado: Desmontar (Hora)","LATE_SCHED_FIN_DATE_EXEC" => "Fin más tardío programado: Ejecución (Fecha)","LATE_SCHED_FIN_TIME_EXEC" => "Fin más tardío programado: Efectuar (hora)","WORK_CENTER" => "Puesto de trabajo","WORK_CENTER_TEXT" => "Texto breve para puesto de trabajo","SYSTEM_STATUS" => "Status sistema","SUBOPERATION" => "Suboperación",
                     );
        return $Campo[$campo];
	}
};
?>

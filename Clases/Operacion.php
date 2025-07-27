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
		$Campo=array("id" => "id","AUFNR" => "N�mero de orden","ROUTING_NO" => "N� hoja ruta de operaciones en orden","COUNTER" => "Contador general de la orden","SEQUENCE_NO" => "Secuencia","CONF_NO" => "N�mero de notificaci�n de la operaci�n","CONF_CNT" => "Contador de notificaci�n","PURCHASE_REQ_NO" => "N�mero de solicitud de pedido","PURCHASE_REQ_ITEM" => "N�mero de posici�n de la socitud de pedido en la o","GROUP_COUNTER" => "Contador grupo hojas ruta","TASK_LIST_TYPE" => "Tipo de hoja de ruta","TASK_LIST_GROUP" => "Clave de grupo hojas de ruta","OPERATION_NUMBER" => "N�mero de operaci�n","OPR_CNTRL_KEY" => "Clave de control","PROD_PLANT" => "Centro","DESCRIPTION" => "Texto breve operaci�n","DESCRIPTION2" => "Descripci�n operaci�n: 2. l�nea de texto","STANDARD_VALUE_KEY" => "Clave de valor prefijado","ACTIVITY_TYPE_1" => "Clase de actividad","ACTIVITY_TYPE_2" => "Clase de actividad","ACTIVITY_TYPE_3" => "Clase de actividad","ACTIVITY_TYPE_4" => "Clase de actividad","ACTIVITY_TYPE_5" => "Clase de actividad","ACTIVITY_TYPE_6" => "Clase de actividad","UNIT" => "Unidad de medida de la operaci�n","UNIT_ISO" => "C�digo ISO p.unidad de medida","QUANTITY" => "Cantidad de operaci�n","SCRAP" => "Cantidad de rechazo de la operaci�n","EARL_SCHED_START_DATE_EXEC" => "Inicio m�s temprano pogramado: Ejecuci�n  (Fecha)","EARL_SCHED_START_TIME_EXEC" => "Inicio m�s temprano programado: Ejecuci�n (Hora)","EARL_SCHED_START_DATE_PROC" => "Inicio m�s temprano programado: Tratar (fecha)","EARL_SCHED_START_TIME_PROC" => "Inicio m�s temprano programado: tratar (hora)","EARL_SCHED_START_DATE_TEARD" => "Inicio m�s temprano programado: Desmontar (fecha)","EARL_SCHED_START_TIME_TEARD" => "Inicio m�s temprano programado: Desmontar (hora)","EARL_SCHED_FIN_DATE_EXEC" => "Fin m�s temprano programado: Ejecuci�n (Fecha)","EARL_SCHED_FIN_TIME_EXEC" => "Fin m�s temprano programado: Ejecutar (hora)","LATE_SCHED_START_DATE_EXEC" => "Inicio programado m�s tard�o: Efectuar (fecha)","LATE_SCHED_START_TIME_EXEC" => "Inicio m�s tard�o programado: Efectuar (Hora)","LATE_SCHED_START_DATE_PROC" => "Inicio m�s tard�o programado: Tratar (fecha)","LATE_SCHED_START_TIME_PROC" => "Inicio m�s tard�o programado: Tratar (hora)","LATE_SCHED_START_DATE_TEARD" => "Inicio m�s tard�o programado: Desmontar (Fecha)","LATE_SCHED_START_TIME_TEARD" => "Inicio m�s tard�o programado: Desmontar (Hora)","LATE_SCHED_FIN_DATE_EXEC" => "Fin m�s tard�o programado: Ejecuci�n (Fecha)","LATE_SCHED_FIN_TIME_EXEC" => "Fin m�s tard�o programado: Efectuar (hora)","WORK_CENTER" => "Puesto de trabajo","WORK_CENTER_TEXT" => "Texto breve para puesto de trabajo","SYSTEM_STATUS" => "Status sistema","SUBOPERATION" => "Suboperaci�n",
                     );
        return $Campo[$campo];
	}
};
?>

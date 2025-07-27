<?php
include_once('DATA_CONF.php');
include_once('Material.php');
include_once('Componente.php');
class OrdenProduccion extends SuperClase{
	function OrdenProduccion() {
		$this->CLASE_OBJETO='OrdenProduccion';
	}
	function buscarExtendido($vord_nmbr) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"ORDER_NUMBER  = '$vord_nmbr'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	function posicionMaterial($vmaterial) {
		$rela = new Componente();
		$rela = MyActiveRecord :: FindFirst('Componente',"ORDER_NUMBER  = '$this->ORDER_NUMBER' AND MATERIAL='$vmaterial'");
		if (!$rela){
			return 0;
		}else{
			return ((int) $rela->RESERVATION_ITEM);
		};
		
	}
	function existe($vord_nmbr) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"ORDER_NUMBER  = '$vord_nmbr'");
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
		$Campo=array("id" => "id","ORDER_NUMBER" => "N�mero de orden","PRODUCTION_PLANT" => "Centro","MRP_CONTROLLER" => "Planificador necesidades para orden","PRODUCTION_SCHEDULER" => "Responsable de control de producci�n","MATERIAL" => "N�mero de material","EXPL_DATE" => "Fecha de explosi�n p. lista materiales y hoja de r","ROUTING_NO" => "N� hoja ruta de operaciones en orden","RESERVATION_NUMBER" => "N�mero de la reserva/las necesidades secundarias","SCHED_RELEASE_DATE" => "Fecha de liberaci�n programada","ACTUAL_RELEASE_DATE" => "Fecha de liberaci�n real","FINISH_DATE" => "Fecha fin extrema","START_DATE" => "Fecha de inicio extrema","PRODUCTION_FINISH_DATE" => "Fin programado","PRODUCTION_START_DATE" => "Inicio programado","ACTUAL_START_DATE" => "Fecha inicio real","ACTUAL_FINISH_DATE" => "Fecha fin real","SCRAP" => "Cantidad de rechazo total de la orden","TARGET_QUANTITY" => "Cantidad total de la orden","UNIT" => "Unidad de medida conjunta para todas las posicione","UNIT_ISO" => "C�digo ISO p.unidad de medida","PRIORITY" => "Prioridad de la orden","ORDER_TYPE" => "Clase de orden","ENTERED_BY" => "Nombre del autor","ENTER_DATE" => "Fecha entrada","DELETION_FLAG" => "Petici�n de borrado","WBS_ELEMENT" => "Elemento del plan de estructura de proyecto (eleme","CONF_NO" => "N�mero de notificaci�n de la operaci�n","CONF_CNT" => "Contador interno","INT_OBJ_NO" => "Configuraci�n (n�mero de objeto interno)","SCHED_FIN_TIME" => "Hora de fin programada","SCHED_START_TIME" => "Inicio programado (hora)","COLLECTIVE_ORDER" => "Indicador: la orden es parte de un grafo de orden","ORDER_SEQ_NO" => "N� secuencia de orden","FINISH_TIME" => "Hora de fin extrema","START_TIME" => "Fecha de inicio extrema (hora)","ACTUAL_START_TIME" => "Hora de inicio real","LEADING_ORDER" => "Orden principal en el marco del tratamiento actual","SALES_ORDER" => "N�mero del pedido de cliente","SALES_ORDER_ITEM" => "N�mero de posici�n en el pedido de cliente","PROD_SCHED_PROFILE" => "Perfil de control de fabricaci�n","MATERIAL_TEXT" => "Texto breve de material","SYSTEM_STATUS" => "Status sistema","CONFIRMED_QUANTITY" => "Ctd confirmada de orden tras verificaci�n componen","PLAN_PLANT" => "Centro de planificaci�n","BATCH" => "N�mero de lote","MATERIAL_EXTERNAL" => "N�mero largo de material para campo MATERIAL","MATERIAL_GUID" => "UID externo para campo MATERIAL","MATERIAL_VERSION" => "N�mero de versi�n para campo MATERIAL","DATE_OF_EXPIRY" => "Fecha de vencimiento (FC) o de vencimiento","DATE_OF_MANUFACTURE" => "Fecha producci�n/fabricaci�n","STLNR"=>"Lista de Materiales"
                     );
        return $Campo[$campo];
	}
};
?>

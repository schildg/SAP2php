<?php
include_once('DATA_CONF.php');
include_once('OrdenProduccion.php');
class Posicion extends SuperClase{
	function Posicion() {
		$this->CLASE_OBJETO='Posicion';
	}
	function buscarExtendido($vord_nmbr,$vitem_number) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"ORDER_NUMBER = '$vord_nmbr' AND ORDER_ITEM_NUMBER = '$vitem_number'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	function existe($vord_nmbr,$vitem_number) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"ORDER_NUMBER = '$vord_nmbr' AND ORDER_ITEM_NUMBER = '$vitem_number'");
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
		$Campo=array("id" => "id","ORDER_NUMBER" => "Número de orden","ORDER_ITEM_NUMBER" => "Número de posición de orden","SALES_ORDER" => "Número del pedido de cliente","SALES_ORDER_ITEM" => "Posición pedido de cliente","SCRAP" => "Cantidad de rechazo de posición","QUANTITY" => "Cantidad de posición de la orden","DELIVERED_QUANTITY" => "Cantidad de entrada de mercancía para posición de ","BASE_UNIT" => "Unidad de medida base","BASE_UNIT_ISO" => "Código ISO p.unidad de medida","MATERIAL" => "Número de material para orden","ACTUAL_DELIVERY_DATE" => "Fecha de entrega/final real","PLANNED_DELIVERY_DATE" => "Fecha de entrega de la orden previsional","PLAN_PLANT" => "Centro de planificación para la orden","STORAGE_LOCATION" => "Almacén","DELIVERY_COMPL" => "Indicador de entrega final","PRODUCTION_VERSION" => "Versión de fabricación","PROD_PLANT" => "Centro","ORDER_TYPE" => "Clase de orden","FINISH_DATE" => "Fecha fin extrema","PRODUCTION_FINISH_DATE" => "Fin programado","BATCH" => "Número de lote","DELETION_FLAG" => "Petición de borrado","MRP_AREA" => "Área pl.nec.","MATERIAL_TEXT" => "Texto breve de material","MATERIAL_EXTERNAL" => "Número largo de material para campo MATERIAL","MATERIAL_GUID" => "UID externo para campo MATERIAL","MATERIAL_VERSION" => "Número de versión para campo MATERIAL",
                     );
        return $Campo[$campo];
	}
};
?>

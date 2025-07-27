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
		$Campo=array("id" => "id","ORDER_NUMBER" => "N�mero de orden","ORDER_ITEM_NUMBER" => "N�mero de posici�n de orden","SALES_ORDER" => "N�mero del pedido de cliente","SALES_ORDER_ITEM" => "Posici�n pedido de cliente","SCRAP" => "Cantidad de rechazo de posici�n","QUANTITY" => "Cantidad de posici�n de la orden","DELIVERED_QUANTITY" => "Cantidad de entrada de mercanc�a para posici�n de ","BASE_UNIT" => "Unidad de medida base","BASE_UNIT_ISO" => "C�digo ISO p.unidad de medida","MATERIAL" => "N�mero de material para orden","ACTUAL_DELIVERY_DATE" => "Fecha de entrega/final real","PLANNED_DELIVERY_DATE" => "Fecha de entrega de la orden previsional","PLAN_PLANT" => "Centro de planificaci�n para la orden","STORAGE_LOCATION" => "Almac�n","DELIVERY_COMPL" => "Indicador de entrega final","PRODUCTION_VERSION" => "Versi�n de fabricaci�n","PROD_PLANT" => "Centro","ORDER_TYPE" => "Clase de orden","FINISH_DATE" => "Fecha fin extrema","PRODUCTION_FINISH_DATE" => "Fin programado","BATCH" => "N�mero de lote","DELETION_FLAG" => "Petici�n de borrado","MRP_AREA" => "�rea pl.nec.","MATERIAL_TEXT" => "Texto breve de material","MATERIAL_EXTERNAL" => "N�mero largo de material para campo MATERIAL","MATERIAL_GUID" => "UID externo para campo MATERIAL","MATERIAL_VERSION" => "N�mero de versi�n para campo MATERIAL",
                     );
        return $Campo[$campo];
	}
};
?>

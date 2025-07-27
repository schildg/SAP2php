<?php
include_once('DATA_CONF.php');
include_once('Material.php');
include_once('OrdenProduccion.php');
class Componente extends SuperClase{
	function Componente() {
		$this->CLASE_OBJETO='Componente';
	}
	function buscarExtendido($vord_nmbr,$vreser_item) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"ORDER_NUMBER = '$vord_nmbr' AND RESERVATION_ITEM = '$vreser_item'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	function existe($vord_nmbr,$vreser_item) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"ORDER_NUMBER = '$vord_nmbr' AND RESERVATION_ITEM = '$vreser_item'");
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
		$Campo=array("id" => "id","RESERVATION_NUMBER" => "Número de la reserva/las necesidades secundarias","RESERVATION_ITEM" => "Número de posición de reserva/necesidades secundar","RESERVATION_TYPE" => "Clase de registro","DELETION_INDICATOR" => "Posición borrada","MATERIAL" => "Número de material","PROD_PLANT" => "Centro","STORAGE_LOCATION" => "Almacén","SUPPLY_AREA" => "Área de suministro de producción","BATCH" => "Número de lote","SPECIAL_STOCK" => "Indicador de stock especial","REQ_DATE" => "Fecha de necesidad del componente","REQ_QUAN" => "Cantidad necesaria","BASE_UOM" => "Unidad de medida base","BASE_UOM_ISO" => "Código ISO p.unidad de medida","WITHDRAWN_QUANTITY" => "Cantidad tomada","ENTRY_QUANTITY" => "Cantidad en unidad de medida de entrada","ENTRY_UOM" => "Unidad de medida de entrada","ENTRY_UOM_ISO" => "Código ISO p.unidad de medida","ORDER_NUMBER" => "Número de orden","MOVEMENT_TYPE" => "Clase de movimiento (gestión stocks)","ITEM_CATEGORY" => "Tipo de posición (Lista de materiales)","ITEM_NUMBER" => "Número de posición de lista de materiales","SEQUENCE" => "Secuencia","OPERATION" => "Número de operación","BACKFLUSH" => "Indicador: toma retroactiva","VALUATION_SPEC_STOCK" => "Valoración stock especial","SYSTEM_STATUS" => "Texto de status editado","MATERIAL_DESCRIPTION" => "Texto breve de material","COMMITED_QUANTITY" => "Cantidad confirmada","SHORTAGE" => "Cantidad faltante","PURCHASE_REQ_NO" => "Número de la solicitud de pedido","PURCHASE_REQ_ITEM" => "Número de posición de la solicitud de pedido","MATERIAL_EXTERNAL" => "Número largo de material para campo MATERIAL","MATERIAL_GUID" => "UID externo para campo MATERIAL","MATERIAL_VERSION" => "Número de versión para campo MATERIAL",
                     );
        return $Campo[$campo];
	}
};
?>

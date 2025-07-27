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
		$Campo=array("id" => "id","RESERVATION_NUMBER" => "N�mero de la reserva/las necesidades secundarias","RESERVATION_ITEM" => "N�mero de posici�n de reserva/necesidades secundar","RESERVATION_TYPE" => "Clase de registro","DELETION_INDICATOR" => "Posici�n borrada","MATERIAL" => "N�mero de material","PROD_PLANT" => "Centro","STORAGE_LOCATION" => "Almac�n","SUPPLY_AREA" => "�rea de suministro de producci�n","BATCH" => "N�mero de lote","SPECIAL_STOCK" => "Indicador de stock especial","REQ_DATE" => "Fecha de necesidad del componente","REQ_QUAN" => "Cantidad necesaria","BASE_UOM" => "Unidad de medida base","BASE_UOM_ISO" => "C�digo ISO p.unidad de medida","WITHDRAWN_QUANTITY" => "Cantidad tomada","ENTRY_QUANTITY" => "Cantidad en unidad de medida de entrada","ENTRY_UOM" => "Unidad de medida de entrada","ENTRY_UOM_ISO" => "C�digo ISO p.unidad de medida","ORDER_NUMBER" => "N�mero de orden","MOVEMENT_TYPE" => "Clase de movimiento (gesti�n stocks)","ITEM_CATEGORY" => "Tipo de posici�n (Lista de materiales)","ITEM_NUMBER" => "N�mero de posici�n de lista de materiales","SEQUENCE" => "Secuencia","OPERATION" => "N�mero de operaci�n","BACKFLUSH" => "Indicador: toma retroactiva","VALUATION_SPEC_STOCK" => "Valoraci�n stock especial","SYSTEM_STATUS" => "Texto de status editado","MATERIAL_DESCRIPTION" => "Texto breve de material","COMMITED_QUANTITY" => "Cantidad confirmada","SHORTAGE" => "Cantidad faltante","PURCHASE_REQ_NO" => "N�mero de la solicitud de pedido","PURCHASE_REQ_ITEM" => "N�mero de posici�n de la solicitud de pedido","MATERIAL_EXTERNAL" => "N�mero largo de material para campo MATERIAL","MATERIAL_GUID" => "UID externo para campo MATERIAL","MATERIAL_VERSION" => "N�mero de versi�n para campo MATERIAL",
                     );
        return $Campo[$campo];
	}
};
?>

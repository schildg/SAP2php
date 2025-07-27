<?php
include_once('DATA_CONF.php');
class Flujo_CRM_TMP extends SuperClase{
	function Flujo_CRM_TMP() {
		$this->CLASE_OBJETO='Flujo_CRM_TMP';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","BUKRS" => "Sociedad","MATNR" => "Número de material","WERKS" => "Centro","ORDEN" => "ORDEN EN SAP","PLNGSEGMT" => "Sección de planif. de necesidades","PLNGSEGNO" => "Número de segmento de planificación","SORT_DATE" => "Campo numérico de longitud 8","SORTIND_00" => "Turno diario (Indicador clasif.-0)","SORTIND_01" => "Indicador de clasificación 01","SORTIND_02" => "Indicador de clasificación 02","MRP_ELEMENT_IND" => "Elemento de planificación","PLUS_MINUS" => "Indicador de entrada/salida","AVAILABLE" => "Indicador de disponibilidad","AVAIL_DATE" => "Fecha de entrada/necesidad","FINISH_DATE" => "Fecha de entrega/fin-orden","MRP_ELEMNT" => "Denominación breve del elemento de planificación","ELEMNT_DATA" => "Datos para el elemento de planificación de necesid","EXCMSGKEY" => "Clave del mensaje de excepción","EXCMESSAGE" => "Número del mensaje de excepción","REC_REQD_QTY" => "Cantidad entrada mercancías o cantidad necesaria","AVAIL_QTY1" => "Cantidad disponible","AVAIL_QTY2" => "Cantidad disponible","ATP_QTY" => "Cantidad ATP","FBYTE" => "Indicador de una posición","SELECTION" => "Indicador de selección","EXCEP_IND" => "Indicador de excepción","PROD_VERSION" => "Versión de fabricación","BOMEXPL_NO" => "Número de serie","REV_LEV" => "Estado de revisión","SCRAP" => "Cantidad de rechazo variable","START_DATE" => "Fecha de inicio/lanzamiento","OPEN_DATE" => "Fecha de apertura","SPPROCTYPE" => "Clase de aprovisionamiento especial","EXT_SPPROCTYPE" => "Aprovisionamiento especial, representación externa","PLAN_PLANT1" => "Centro de planificación","PLAN_PLANT2" => "Centro de planificación","STG_LOC_2" => "Almacén receptor/de procedencia","STORAGE_LOC" => "Almacén","RESCHED_DATE" => "Fecha de reprogramación","VENDOR_NO" => "Número de cuenta del proveedor o acreedor","CUSTOMER" => "Número de deudor","CUST_NAME" => "Nombre de cliente","VEND_NAME" => "Nombre del proveedor","LOW_LEVEL_EXCPT" => "Excepción en nivel inferior de lista de materiales","STOCK_IN_TRANSIT" => "Planificación de necesidades: stock en tránsito","USER_EXIT1" => "Campo en el que se introducen datos vía exit usuar","USER_EXIT2" => "Campo en el que se introducen datos vía exit usuar","USER_EXIT3" => "Campo en el que se introducen datos vía exit usuar","SORTIND_KD" => "Indicador clasific.p.segmentos cliente individual","REC_REQD_QTY_ALT_UOM" => "Cantidad entrada mercancías o cantidad necesaria","AVAIL_QTY_ALT_UOM" => "Cantidad disponible","TEXT_FIELD_ALT_UOM" => "Campo de texto","ICON_TEXT" => "Campo portador para iconos",
                     );
        return $Campo[$campo];
	}
	function save(){
		$this->KEY_ID=$this->BUKRS.$this->MATNR.$this->WERKS.$this->ORDEN;
		parent :: save();
	}
	
};
?>

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
		$Campo=array("id" => "id","BUKRS" => "Sociedad","MATNR" => "N�mero de material","WERKS" => "Centro","ORDEN" => "ORDEN EN SAP","PLNGSEGMT" => "Secci�n de planif. de necesidades","PLNGSEGNO" => "N�mero de segmento de planificaci�n","SORT_DATE" => "Campo num�rico de longitud 8","SORTIND_00" => "Turno diario (Indicador clasif.-0)","SORTIND_01" => "Indicador de clasificaci�n 01","SORTIND_02" => "Indicador de clasificaci�n 02","MRP_ELEMENT_IND" => "Elemento de planificaci�n","PLUS_MINUS" => "Indicador de entrada/salida","AVAILABLE" => "Indicador de disponibilidad","AVAIL_DATE" => "Fecha de entrada/necesidad","FINISH_DATE" => "Fecha de entrega/fin-orden","MRP_ELEMNT" => "Denominaci�n breve del elemento de planificaci�n","ELEMNT_DATA" => "Datos para el elemento de planificaci�n de necesid","EXCMSGKEY" => "Clave del mensaje de excepci�n","EXCMESSAGE" => "N�mero del mensaje de excepci�n","REC_REQD_QTY" => "Cantidad entrada mercanc�as o cantidad necesaria","AVAIL_QTY1" => "Cantidad disponible","AVAIL_QTY2" => "Cantidad disponible","ATP_QTY" => "Cantidad ATP","FBYTE" => "Indicador de una posici�n","SELECTION" => "Indicador de selecci�n","EXCEP_IND" => "Indicador de excepci�n","PROD_VERSION" => "Versi�n de fabricaci�n","BOMEXPL_NO" => "N�mero de serie","REV_LEV" => "Estado de revisi�n","SCRAP" => "Cantidad de rechazo variable","START_DATE" => "Fecha de inicio/lanzamiento","OPEN_DATE" => "Fecha de apertura","SPPROCTYPE" => "Clase de aprovisionamiento especial","EXT_SPPROCTYPE" => "Aprovisionamiento especial, representaci�n externa","PLAN_PLANT1" => "Centro de planificaci�n","PLAN_PLANT2" => "Centro de planificaci�n","STG_LOC_2" => "Almac�n receptor/de procedencia","STORAGE_LOC" => "Almac�n","RESCHED_DATE" => "Fecha de reprogramaci�n","VENDOR_NO" => "N�mero de cuenta del proveedor o acreedor","CUSTOMER" => "N�mero de deudor","CUST_NAME" => "Nombre de cliente","VEND_NAME" => "Nombre del proveedor","LOW_LEVEL_EXCPT" => "Excepci�n en nivel inferior de lista de materiales","STOCK_IN_TRANSIT" => "Planificaci�n de necesidades: stock en tr�nsito","USER_EXIT1" => "Campo en el que se introducen datos v�a exit usuar","USER_EXIT2" => "Campo en el que se introducen datos v�a exit usuar","USER_EXIT3" => "Campo en el que se introducen datos v�a exit usuar","SORTIND_KD" => "Indicador clasific.p.segmentos cliente individual","REC_REQD_QTY_ALT_UOM" => "Cantidad entrada mercanc�as o cantidad necesaria","AVAIL_QTY_ALT_UOM" => "Cantidad disponible","TEXT_FIELD_ALT_UOM" => "Campo de texto","ICON_TEXT" => "Campo portador para iconos",
                     );
        return $Campo[$campo];
	}
	function save(){
		$this->KEY_ID=$this->BUKRS.$this->MATNR.$this->WERKS.$this->ORDEN;
		parent :: save();
	}
	
};
?>

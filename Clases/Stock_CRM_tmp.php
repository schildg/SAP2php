<?php
include_once('DATA_CONF.php');
class Stock_CRM_tmp extends SuperClase{
	function Stock_CRM_tmp() {
		$this->CLASE_OBJETO='Stock_CRM_tmp';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","MATNR" => "N�mero de material","WERKS" => "Centro","LGORT" => "Almac�n","LABST" => "Stock valorado de libre utilizaci�n","INSME" => "Stock en control de calidad","RESERV" => "Cantidad","RESERVENTRE" => "Cantidad","CURSO" => "Cantidad","CU" => "Cantidad","CU_USD" => "Cantidad","TRANSITO" => "Cantidad",
                     );
        return $Campo[$campo];
	}
	function save() {
		$this->RESERV=0;
		parent :: save();
	}
	
};
?>

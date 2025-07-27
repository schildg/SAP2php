<?php
include_once('DATA_CONF.php');
class Stock_CRM extends SuperClase{
	function Stock_CRM() {
		$this->CLASE_OBJETO='Stock_CRM';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","MATNR" => "Número de material","WERKS" => "Centro","LGORT" => "Almacén","LABST" => "Stock valorado de libre utilización","INSME" => "Stock en control de calidad","RESERV" => "Cantidad","RESERVENTRE" => "Cantidad","CURSO" => "Cantidad","CU" => "Cantidad","CU_USD" => "Cantidad","TRANSITO" => "Cantidad",
                     );
        return $Campo[$campo];
	}
};
?>

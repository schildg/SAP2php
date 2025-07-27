<?php
include_once('DATA_CONF.php');
class Actu_Flujo_CRM extends SuperClase{
	function Actu_Flujo_CRM() {
		$this->CLASE_OBJETO='Actu_Flujo_CRM';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","MATNR" => "Número de material","WERKS" => "Centro","BUKRS" => "Sociedad","Flujo_Actualizado" => "Flujo_Actualizado",
                     );
        return $Campo[$campo];
	}
};
?>

<?php
include_once('DATA_CONF.php');
class CPendientes_CRM_TMP extends SuperClase{
	function CPendientes_CRM_TMP() {
		$this->CLASE_OBJETO='CPendientes_CRM_TMP';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","BUKRS" => "BUKRS","EBELN" => "EBELN","EBELP" => "EBELP","EKORG" => "EKORG","EKGRP" => "EKGRP","BSART" => "BSART","AEDAT" => "AEDAT","EEIND" => "EEIND","LIFNR" => "LIFNR","MATNR" => "MATNR","WERKS" => "WERKS","LGORT" => "LGORT","MENGE" => "MENGE","MEINS" => "MEINS","WAERS" => "WAERS","WKURS" => "WKURS","CU_PESO" => "CU_PESO","CU_DOLAR" => "CU_DOLAR","COSTO_PESO" => "COSTO_PESO","COSTO_DOLAR" => "COSTO_DOLAR","COSTO_NAC_PESO" => "COSTO_NAC_PESO","COSTO_NAC_DOLAR" => "COSTO_NAC_DOLAR","ESTADO" => "ESTADO",
                     );
        return $Campo[$campo];
	}
	function save(){
		$this->CRM_ID=$this->LIFNR.$this->EKORG;
		$this->KEY_ID=$this->BUKRS.$this->EKORG.$this->EBELN.$this->EBELP.$this->MATNR.$this->EEIND;
		if(trim($this->LGORT)==''){
			$this->LGORT='ASD';
		}
		parent :: save();
	}
	
};
?>

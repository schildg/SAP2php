<?php
include_once('DATA_CONF.php');
class Vendedor_CRM_TMP extends SuperClase{
	function Vendedor_CRM_TMP() {
		$this->CLASE_OBJETO='Vendedor_CRM_TMP';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","KUNNR" => "N�mero de deudor","MATNR" => "N�mero de material","KUNN2" => "N�mero de cliente del interlocutor","VKORG" => "Organizaci�n de ventas","WAERK" => "Tabla R/2","ZTERM" => "Clave de las condiciones de pa","BSARK" => "Clase de pedido de cliente","AUART" => "Clase de documento de ventas","WERKS" => "Centro","LGORT" => "Almac�n","PRCTR" => "Centro de beneficio","VKGRP" => "Grupo de vendedores","VKBUR" => "Oficina de ventas","XBLNR" => "N�mero de documento de referencia","VBELN" => "N�mero de documento comercial","ERDAT" => "Fecha de creaci�n del registro","PU_ML" => "30 caracteres","PU_USD" => "30 caracteres","NETPR" => "30 caracteres","NETPR_USD" => "30 caracteres","CU_ML" => "30 caracteres","CU_USD" => "30 caracteres","WAVWR" => "30 caracteres","WAVWR_USD" => "30 caracteres","ZMENG" => "30 caracteres","ZIEME" => "30 caracteres","STCUR" => "30 caracteres","BSTNK" => "N�mero de pedido del cliente","MEINS" => "Campo con longitud de 3 byte","VRKME" => "Campo con longitud de 3 byte",
                     );
        return $Campo[$campo];
	}
	function save(){
		$this->CRM_ID=$this->KUNNR.$this->VKORG;
		parent :: save();
	}
	
};
?>

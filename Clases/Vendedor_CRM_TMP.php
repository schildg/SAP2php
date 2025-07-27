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
		$Campo=array("id" => "id","KUNNR" => "Número de deudor","MATNR" => "Número de material","KUNN2" => "Número de cliente del interlocutor","VKORG" => "Organización de ventas","WAERK" => "Tabla R/2","ZTERM" => "Clave de las condiciones de pa","BSARK" => "Clase de pedido de cliente","AUART" => "Clase de documento de ventas","WERKS" => "Centro","LGORT" => "Almacén","PRCTR" => "Centro de beneficio","VKGRP" => "Grupo de vendedores","VKBUR" => "Oficina de ventas","XBLNR" => "Número de documento de referencia","VBELN" => "Número de documento comercial","ERDAT" => "Fecha de creación del registro","PU_ML" => "30 caracteres","PU_USD" => "30 caracteres","NETPR" => "30 caracteres","NETPR_USD" => "30 caracteres","CU_ML" => "30 caracteres","CU_USD" => "30 caracteres","WAVWR" => "30 caracteres","WAVWR_USD" => "30 caracteres","ZMENG" => "30 caracteres","ZIEME" => "30 caracteres","STCUR" => "30 caracteres","BSTNK" => "Número de pedido del cliente","MEINS" => "Campo con longitud de 3 byte","VRKME" => "Campo con longitud de 3 byte",
                     );
        return $Campo[$campo];
	}
	function save(){
		$this->CRM_ID=$this->KUNNR.$this->VKORG;
		parent :: save();
	}
	
};
?>

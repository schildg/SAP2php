<?php
include_once('DATA_CONF.php');
class Venta_Anita extends SuperClase{
	function Venta_Anita() {
		$this->CLASE_OBJETO='Venta_Anita';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","CRM_ID" => "CRM_ID","KUNNR" => "KUNNR","MATNR" => "MATNR","KUNN2" => "KUNN2","VKORG" => "VKORG","UNNEG" => "UNNEG","WAERK" => "WAERK","ZTERM" => "ZTERM","BSARK" => "BSARK","AUART" => "AUART","WERKS" => "WERKS","LGORT" => "LGORT","PRCTR" => "PRCTR","VKGRP" => "VKGRP","VKBUR" => "VKBUR","XBLNR" => "XBLNR","VBELN" => "VBELN","POSNR" => "POSNR","ERDAT" => "ERDAT","PU_ML" => "PU_ML","PU_USD" => "PU_USD","NETPR" => "NETPR","NETPR_USD" => "NETPR_USD","CU_ML" => "CU_ML","CU_USD" => "CU_USD","WAVWR" => "WAVWR","WAVWR_USD" => "WAVWR_USD","ZMENG" => "ZMENG","ZIEME" => "ZIEME","STCUR" => "STCUR","BSTNK" => "BSTNK","MEINS" => "MEINS","VRKME" => "VRKME","HB_EXPDATE" => "HB_EXPDATE","BUKRS" => "BUKRS","FKART" => "FKART","KKBER" => "KKBER","DOCFI" => "DOCFI","GJAHR" => "GJAHR","BLART" => "BLART","SHKZG" => "SHKZG","ZFBDT" => "ZFBDT","PERIO" => "PERIO",
                     );
        return $Campo[$campo];
	}
};
?>

<?php
include_once('DATA_CONF.php');
class Cheques extends SuperClase{
	function Cheques() {
		$this->CLASE_OBJETO='Cheques';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","BUKRS" => "Sociedad","NCHCK" => "Nro de Cheque","BLDAT" => "Fecha Documento Ingreso","BELNR" => "Nro Documento Ingreso","GJAHR" => "Ejercicio","BUZEI" => "Número del apunte contable dentro del documento co","FEEMI" => "Fecha de Emision","FEVEN" => "Fecha de Vencimiento","TPCHK" => "Tipo de Cheque","INDDF" => "Indicador Diferido","BANK" => "Banco","SUCU" => "Sucursal","POST" => "Codigo Postal","LOCA" => "Localidad","CHCKR" => "Nro Cheque Real","WAERS" => "Clave de moneda","WRBTR" => "Importe en la moneda del documento","CTAB" => "Cta Bancaria","CART" => "Cartera Fisica","CLAU" => "Cláusula","EMIS" => "CUIT emisor","KUNNR" => "Cliente","SEGMT" => "Segmento","LOTE" => "Lote","ESTAD" => "Estado de Cheque - Historial","SEL" => "Indicador de una posición",
                     );
        return $Campo[$campo];
	}
	function buscarExtendido($vBUKRS,$vBELNR,$vGJAHR,$vNCHCK) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"BUKRS = '$vBUKRS' AND NCHCK = '$vNCHCK' AND BELNR = '$vBELNR' AND GJAHR = '$vGJAHR'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	function save(){
		$vkorg = 0;
		switch ($this->KKBER) {
			case "ACFE":$vkorg=2010;break;
			case "ACFO":$vkorg=2020;break;
			case "ACIN":$vkorg=2030;break;
		}
		$this->CRM_ID=$this->KUNNR.$vkorg;
		parent :: save();
	}
	
};
?>

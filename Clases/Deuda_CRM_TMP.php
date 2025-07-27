<?php
include_once('DATA_CONF.php');
class Deuda_CRM_TMP extends SuperClase{
	function Deuda_CRM_TMP() {
		$this->CLASE_OBJETO='Deuda_CRM_TMP';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","FECHA" => "Campo de texto, longitud 10","CODIGO_PAIS" => "Char 15","BLART" => "Clase de documento","VBELN" => "N�mero de documento comercial","BUKRS" => "Sociedad","BELNR" => "N�mero de un documento contable","GJAHR" => "Ejercicio","XBLNR" => "N�mero de documento de referencia","WAERK" => "Moneda de documento comercial","VKORG" => "Organizaci�n de ventas","VTWEG" => "Canal de distribuci�n","FKDAT" => "Fecha de factura para el �ndice de factura e impre","KURRF" => "Curr 11,3","ZTERM" => "Clave de las condiciones de pa","KUNNR" => "N�mero de deudor","KUNN2" => "30 caracteres","DMBTR" => "Importe en moneda local","DMBE2" => "Importe en moneda local","SABTR" => "Importe en moneda local","SABE2" => "Importe en moneda local","KKBER" => "�rea de control de cr�ditos","ZFBDT" => "Fecha base para c�lculo del vencimiento","SHKZG" => "Indicador debe/haber",
                     );
        return $Campo[$campo];
	}
	function save(){
		switch ($this->KKBER) {
			case "ACFE":$this->VKORG="2010";break;
			case "ACFO":$this->VKORG="2020";break;
			case "ACIN":$this->VKORG="2030";break;
		}						
		
		parent :: save();
	}
	
};
?>

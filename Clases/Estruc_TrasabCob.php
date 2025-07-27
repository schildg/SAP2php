<?php
include_once('DATA_CONF.php');
class Estruc_TrasabCob extends SuperClase{
	function Estruc_TrasabCob() {
		$this->CLASE_OBJETO='Estruc_TrasabCob';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","ZNREC" => "N�mero de un documento contable","ZFCON" => "Fecha de contabilizaci�n en el documento","ZFDOC" => "Fecha de contabilizaci�n en el documento","ZIMPO" => "Importe en moneda local","ZNFAC" => "N�mero de documento de referencia","ZNLEG" => "N�mero de documento de referencia","ZFACT" => "N�mero de un documento contable","ZFREC" => "Fecha de contabilizaci�n en el documento","ZFDRE" => "Fecha de contabilizaci�n en el documento","ZCHCK" => "Nro de Cheque","ZFVFA" => "Fecha de contabilizaci�n en el documento","ZVCHE" => "Fecha de contabilizaci�n en el documento","ZTMOV" => "Clase de documento","ZBANK" => "Nombre de la instituci�n financiera","ZMCAN" => "Texto breve de las cuentas de mayor",
                     );
        return $Campo[$campo];
	}
	function buscarExtendido($vZNREC,$vZFACT,$vZSOCI,$vZEJCO) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"ZNREC='$vZNREC' AND ZFACT='$vZFACT' AND ZSOCI='$vZSOCI' AND ZEJCO=$vZEJCO");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	function save(){
		if(trim($this->ZACRE)==""){
			$this->ACALC="X";
			$rela=MyActiveRecord :: FindFirst('Cliente_CRM_TODO',"KUNNR=$this->ZCLIE");
			$this->VKORG=$rela->VKORG;
			switch ($this->VKORG) {
				case "2010":$this->ZACRE="ACFE";break;
				case "2020":$this->ZACRE="ACFO";break;
				case "2030":$this->ZACRE="ACIN";break;
			}	
		}else{
			switch ($this->ZACRE) {
				case "ACFE":$this->VKORG="2010";break;
				case "ACFO":$this->VKORG="2020";break;
				case "ACIN":$this->VKORG="2030";break;
			}								
		}
		switch ($this->VKORG) {
			case "2010":$this->UNNEG="Feed";break;
			case "2020":$this->UNNEG="Food";break;
			case "2030":$this->UNNEG="Industrial";break;
		}
		
		$this->CRM_ID=$this->ZCLIE.$this->VKORG;
		parent :: save();
	}
	
};
?>

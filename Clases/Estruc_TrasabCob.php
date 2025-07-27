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
		$Campo=array("id" => "id","ZNREC" => "Número de un documento contable","ZFCON" => "Fecha de contabilización en el documento","ZFDOC" => "Fecha de contabilización en el documento","ZIMPO" => "Importe en moneda local","ZNFAC" => "Número de documento de referencia","ZNLEG" => "Número de documento de referencia","ZFACT" => "Número de un documento contable","ZFREC" => "Fecha de contabilización en el documento","ZFDRE" => "Fecha de contabilización en el documento","ZCHCK" => "Nro de Cheque","ZFVFA" => "Fecha de contabilización en el documento","ZVCHE" => "Fecha de contabilización en el documento","ZTMOV" => "Clase de documento","ZBANK" => "Nombre de la institución financiera","ZMCAN" => "Texto breve de las cuentas de mayor",
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

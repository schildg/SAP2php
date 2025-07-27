<?php
include_once('DATA_CONF.php');
class Cobranza_CRM_TMP extends SuperClase{
	function Cobranza_CRM_TMP() {
		$this->CLASE_OBJETO='Cobranza_CRM_TMP';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","BELNR" => "BELNR","XBLNR" => "XBLNR","BUDAT" => "BUDAT","BLDAT" => "BLDAT","BUKRS" => "BUKRS","GJAHR" => "GJAHR","BLART" => "BLART","WAERS" => "WAERS","KUNNR_R" => "KUNNR_R","AUGBL_R" => "AUGBL_R","AUGDT_R" => "AUGDT_R","BELNR_3" => "BELNR_3","WRBTS_3" => "WRBTS_3","DMBTR_3" => "DMBTR_3","DMBE2_3" => "DMBE2_3","WAERS_3" => "WAERS_3","CHCKR_CH" => "CHCKR_CH","FEEMI_CH" => "FEEMI_CH","FEVEN_CH" => "FEVEN_CH","BANK_CH" => "BANK_CH","SUCU_CH" => "SUCU_CH","WAERS_CH" => "WAERS_CH","WRBTR_CH" => "WRBTR_CH","KKBER_CH" => "KKBER_CH",
                     );
        return $Campo[$campo];
	}
	function save(){
		if ($this->ZFBDT=="00000000"){
			$this->DIASC = 0;
		}else{
			if($this->SHKZG=='H'){
				$this->DIASC = (mktime(0, 0, 0,  substr($this->ZFBDT,4,2),substr($this->ZFBDT,6,2),substr($this->ZFBDT,0,4)) - mktime(0, 0, 0,  substr($this->AUGDT_R,4,2),substr($this->AUGDT_R,6,2),substr($this->AUGDT_R,0,4)))/60/60/24;							
			}else{
				$this->DIASC = (mktime(0, 0, 0,  substr($this->AUGDT_R,4,2),substr($this->AUGDT_R,6,2),substr($this->AUGDT_R,0,4))- mktime(0, 0, 0,  substr($this->ZFBDT,4,2),substr($this->ZFBDT,6,2),substr($this->ZFBDT,0,4)))/60/60/24;
			}
		}
		$this->IMPO_POND=$this->DIASC*$this->DMBE2_3;
		parent :: save();
	}
	
};
?>

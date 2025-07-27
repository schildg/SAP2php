<?php
include_once('DATA_CONF.php');
class Cliente_CRM_TODO extends SuperClase{
	function Cliente_CRM_TODO() {
		$this->CLASE_OBJETO='Cliente_CRM_TODO';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","CRM_ID" => "N�mero de deudor + Organizaci�n de ventas + Canal ","KUNNR" => "N�mero de deudor","VKORG" => "Organizaci�n de ventas","VTWEG" => "Canal de distribuci�n","SPART" => "Sector","NAME1" => "Razon Social","STCD1" => "N�mero de identificaci�n fiscal 1","STRAS" => "Calle y n�","ORT02" => "Distrito","PSTLZ" => "C�digo postal","REGIO" => "Regi�n (Estado federal, land, provincia, condado)","LAND1" => "Clave de pa�s","FITYP" => "Clase de impuesto","ZTERM" => "Clave de condiciones de pago","KKBER" => "�rea de control de cr�ditos","KLIMK" => "L�mite de cr�dito del cliente","KUNN2" => "N�mero de Vendedor","OWNER" => "Nombre Vendedor",
                     );
        return $Campo[$campo];
	}
	function buscarExtendido($vKUNNR,$vVKORG,$vVTWEG,$vSPART) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"KUNNR = '$vKUNNR' AND VKORG = '$vVKORG' AND VTWEG = '$vVTWEG' AND SPART = '$vSPART'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	function cliente_de_UN($vKUNNR,$vVKORG) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"KUNNR = '$vKUNNR' AND VKORG = '$vVKORG'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	
	function save(){
		if($this->TICL=='Cliente'){
			switch ($this->VKORG) {
				case "2010":$this->UNNEG="Feed";break;
				case "2020":$this->UNNEG="Food";break;
				case "2030":$this->UNNEG="Industrial";break;
				case "2040":$this->UNNEG="Otros";break;
				case "1010":$this->UNNEG="Feed";break;
				case "1020":$this->UNNEG="Food";break;
				case "1030":$this->UNNEG="Industrial";break;
				case "1040":$this->UNNEG="Otros";break;
			}
		}
		$this->VTWEG="";
		$this->SPART="";
		$this->CRM_ID=$this->KUNNR.$this->VKORG;
		
		if($this->FITYP==""){
			$this->FITYP="NA";
		}
		if($this->ZTERM==""){
			$this->ZTERM="N/A";
		}
		$this->REGIO=$this->LAND1.'_'.$this->REGIO01;
		return parent :: save();
	}
	
	
};
?>

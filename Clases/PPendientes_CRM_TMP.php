<?php
include_once('DATA_CONF.php');
class PPendientes_CRM_TMP extends SuperClase{
	function PPendientes_CRM_TMP() {
		$this->CLASE_OBJETO='PPendientes_CRM_TMP';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","BUKRS" => "Sociedad","CRM_ID" => "N�mero de deudor + Organizaci�n de ventas + Canal ","AUART" => "Clase de documento de ventas","VBELN" => "N�mero de documento comercial","POSNR" => "Posici�n documento ventas","VKORG" => "Organizaci�n de ventas","VTWEG" => "Canal de distribuci�n","AUDAT" => "Fecha de documento (fecha de entrada o salida)","VDATU" => "Fecha preferente de entrega","KUNNR" => "N�mero de deudor","KUNN2" => "N�mero de cliente del interlocutor","LAND1" => "Clave de pa�s","MATNR" => "N�mero de material","WERKS" => "Centro","LGORT" => "Almac�n","KWMENG" => "Cantidad de pedido acumulada (en unidades de venta","ZIEME" => "Unidad de medida para la cantidad prevista","WAERK" => "Moneda de documento comercial","STCUR" => "Tipo de cambio para estad�sticas","TOTAL_PESO" => "Precio neto","TOTAL_DOLAR" => "Precio neto","PRECIO_PESO" => "Valor neto en moneda de documento","PRECIO_DOLAR" => "Valor neto en moneda de documento","RFSTA" => "Campo de usuario para cluster PC nacional",
                     );
        return $Campo[$campo];
	}
	function buscarExtendido($vBUKRS,$vAUART,$vVBELN,$vPOSNR,$vETENR) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"BUKRS = '$vBUKRS' AND AUART = '$vAUART' AND VBELN = '$vVBELN' AND POSNR = '$vPOSNR' AND ETENR = '$vETENR'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	
	function save(){
		$this->CRM_ID=$this->KUNNR.$this->VKORG;
		$this->KEY_ID=$this->BUKRS.$this->AUART.$this->VBELN.$this->POSNR.$this->ETENR;
		$this->BSTCL=$this->BSTNK;
		$this->BSTNK=$this->VBELN;
		$this->BSARK=$this->AUART;
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
		if(trim($this->LGORT)==''){
			$this->LGORT='ASD';
		}
		
		parent :: save();
	}
	
};
?>

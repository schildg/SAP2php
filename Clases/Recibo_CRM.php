<?php
include_once('DATA_CONF.php');
class Recibo_CRM extends SuperClase{
	function Recibo_CRM() {
		$this->CLASE_OBJETO='Recibo_CRM';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","BUKRS" => "Sociedad","BELNR" => "Número de un documento contable","GJAHR" => "Ejercicio","BLART" => "Clase de documento","CRM_ID" => "Número de deudor + Organización de ventas + Canal ","FKDAT" => "Fecha de Documento","DICOB" => "Dias Cobranza","KUNNR" => "Número de deudor","DIATR" => "Dias Atraso","KUNN2" => "Número de Vendedor","UNNEG" => "Unidad de Negocios","DMBTR" => "Importe en Moneda Local","DMBE2" => "Importe en Dolares","SABTR" => "Saldo en moneda Local","SABE2" => "Saldo en dolares","WAERS" => "Clave de moneda",
                     );
        return $Campo[$campo];
	}
	function buscarExtendido($vBUKRS,$vBELNR,$vGJAHR) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"BUKRS = '$vBUKRS' AND BELNR = '$vBELNR' AND GJAHR = '$vGJAHR'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	function save(){
		$cab = New Cabecera_Contabilidad();
		$cab = $cab->buscarExtendido($this->BUKRS, $this->BELNR, $this->GJAHR);		
		$lin = New Linea_Contabilidad();
		$lin = MyActiveRecord :: FindFirst("Linea_Contabilidad","BUKRS = '$this->BUKRS' AND BELNR = '$this->BELNR' AND GJAHR = '$this->GJAHR' AND KKBER<>''");		
		$this->KUNNR= $lin->KUNNR;
		$this->DMBE2= $lin->DMBE2;
		$this->DMBTR= $lin->DMBTR;
		$this->FKDAT= $cab->BLDAT;
		switch ($lin->KKBER) {
			case "ACFE":$this->UNNEG="Feed";$vkorg=2010;break;
			case "ACFO":$this->UNNEG="Food";$vkorg=2020;break;
			case "ACIN":$this->UNNEG="Industrial";$vkorg=2030;break;
		}
		
		$this->CRM_ID = $lin->KUNNR.$vkorg;
		$this->VBELN = $this->BUKRS.$this->BELNR.$this->GJAHR;
		
		$cl_crm = NEW Cliente_CRM_TODO();
		$cl_crm = $cl_crm->cliente_de_UN($lin->KUNNR,$vkorg);
		$this->KUNN2=$cl_crm->KUNN2;
//		$cond = New Condicion_Pago();
//		$this->FKVEN=$cond->calcular_vencimiento($this->ZTERM, 0, $this->FKDAT);
//		$this->DIATR=$cond->calcular_dias_atraso($this->ZTERM, 0, $this->FKDAT);

		
		
		
//		echo "KUNNR:".$this->KUNNR." VKORG:".$this->VKORG." VTWEG:".$this->VTWEG." KUNN2:".$inter->KUNN2;
//		$lin = New Linea_Contabilidad();
//		$lin = MyActiveRecord :: FindFirst("Linea_Contabilidad","BUKRS = '$this->BUKRS' AND BELNR = '$this->BELNR' AND GJAHR = '$this->GJAHR' AND SHKZG = 'S'");		
//		$this->DMBE2= $lin->DMBE2;
		parent :: save();
	}
	
	
};
?>

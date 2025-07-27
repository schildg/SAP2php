<?php
include_once('DATA_CONF.php');
class Venta_CRM_TMP extends SuperClase{
	function Venta_CRM_TMP() {
		$this->CLASE_OBJETO='Venta_CRM_TMP';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","KUNNR" => "Número de deudor","MATNR" => "Número de material","KUNN2" => "Número de cliente del interlocutor","VKORG" => "Organización de ventas","WAERK" => "Tabla R/2","ZTERM" => "Clave de las condiciones de pa","BSARK" => "Clase de pedido de cliente","AUART" => "Clase de documento de ventas","WERKS" => "Centro","LGORT" => "Almacén","PRCTR" => "Centro de beneficio","VKGRP" => "Grupo de vendedores","VKBUR" => "Oficina de ventas","XBLNR" => "Número de documento de referencia","VBELN" => "Número de documento comercial","ERDAT" => "Fecha de creación del registro","PU_ML" => "30 caracteres","PU_USD" => "30 caracteres","NETPR" => "30 caracteres","NETPR_USD" => "30 caracteres","CU_ML" => "30 caracteres","CU_USD" => "30 caracteres","WAVWR" => "30 caracteres","WAVWR_USD" => "30 caracteres","ZMENG" => "30 caracteres","ZIEME" => "30 caracteres","STCUR" => "30 caracteres","BSTNK" => "Número de pedido del cliente","MEINS" => "Campo con longitud de 3 byte","VRKME" => "Campo con longitud de 3 byte",
                     );
        return $Campo[$campo];
	}
	function buscarExtendido($vVBELN,$vERDAT,$vKUNNR,$vMATNR,$vPOSNR) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"KUNNR = '$vKUNNR' AND MATNR = '$vMATNR' AND VBELN = '$vVBELN' AND ERDAT = '$vERDAT' AND POSNR = '$vPOSNR'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	function save(){
		$this->CRM_ID=$this->KUNNR.$this->VKORG;
		$this->PERIO=substr($this->ZFBDT,0,6);
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
		
//		if ($this->SHKZG == "H"){
//			$signo= -1;
//		}else{
//			$signo= 1;
//		}
		if($this->ZMENG!=0){
			if(!$this->PU_ML){
				$this->PU_ML=$this->NETPR/$this->ZMENG;
			}			
			if(!$this->PU_USD){
				$this->PU_USD=$this->NETPR_USD/$this->ZMENG;
			}			
			if(!$this->CU_ML){
				$this->CU_ML=$this->WAVWR/$this->ZMENG;
			}			
			if(!$this->CU_USD){
				$this->CU_USD=$this->WAVWR_USD/$this->ZMENG;
			}			
		}
		
		if ($this->TIPO == "C"){
			$tipo_c= 0;
		}else{
			$tipo_c= 1;
		}
		
		$signo= -1;
		$this->NETPR= $this->formatear_nro_sap($this,'NETPR')*$signo;
		$this->NETPR_USD= $this->formatear_nro_sap($this,'NETPR_USD')*$signo;
		$this->ZMENG= $this->formatear_nro_sap($this,'ZMENG')*$signo*$tipo_c;
		$signo= 1;
		$this->WAVWR= $this->formatear_nro_sap($this,'WAVWR')*$signo;
		$this->WAVWR_USD= $this->formatear_nro_sap($this,'WAVWR_USD')*$signo;
		$cond=new Condicion_Pago();
		$this->HB_EXPDATE=$cond->calcular_vencimiento($this->ZTERM, 0, $this->ERDAT);
		parent :: save();
	}
	
};
?>

<?php
include_once('DATA_CONF.php');
class Factura_CRM_TODO extends SuperClase{
	function Factura_CRM_TODO() {
		$this->CLASE_OBJETO='Factura_CRM_TODO';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","VBELN" => "Factura","WAERK" => "Moneda de documento comercial","VKORG" => "Organización de ventas","VTWEG" => "Canal de distribución","FKDAT" => "Fecha de factura para el índice de factura e impre","KURRF" => "Tipo de cambio de moneda para contabilización FI","ZTERM" => "Clave de condiciones de pago","CRM_ID" => "Número de deudor + Organización de ventas + Canal ","FKVEN" => "Fecha de vencimiento","FKREC" => "Fecha Estimada de Reclamo","KUNNR" => "Número de deudor","DIATR" => "Dias Atraso","KUNN2" => "Número de Vendedor",
                     );
        return $Campo[$campo];
	}
	function buscarExtendido($vVBELN) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"VBELN = '$vVBELN'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	function save(){
		if($this->id){
			$ind_deudores = New Deuda_CRM();
			$ind_deudores = MyActiveRecord :: FindFirst("Deuda_CRM","BUKRS = '$this->BUKRS' AND BELNR = '$this->BELNR' AND GJAHR = '$this->GJAHR'");		
			if ($ind_deudores->SHKZG == "H"){
				$signo= -1;
			}else{
				$signo= 1;
			}
			
			if($ind_deudores){
				$this->SABE2= $ind_deudores->DMBE2*$signo;
				$this->SABTR= $ind_deudores->DMBTR*$signo;
				$cond = New Condicion_Pago();
				$this->FKVEN=$cond->calcular_vencimiento($this->ZTERM, 0, $this->FKDAT);
				$this->FKREC=$cond->calcular_dia_reclamo($this->ZTERM, 0, $this->FKDAT);
				$this->DIATR=$cond->calcular_dias_atraso($this->ZTERM, 0, $this->FKDAT);
			}else{
				$this->SABE2= 0;
				$this->SABTR= 0;
				$cond = New Condicion_Pago();
				$this->FKREC=$cond->calcular_dia_reclamo($this->ZTERM, 0, $this->FKDAT);
				$this->FKVEN=$cond->calcular_vencimiento($this->ZTERM, 0, $this->FKDAT);
			}
			parent :: save();
		}else{
			$cab_factura = New Cabecera_Factura();
			$cab_factura = MyActiveRecord :: FindFirst("Cabecera_Factura","VBELN='$this->VBELN'");
			if($cab_factura){// SI ENTRA ES PORQUE VIENE DE LA FACTURA SD, SINO ES UN DOCUMENTO VIEJO CARGDADO EN FACTURA_CRM
				$doc_contable = New Cabecera_Contabilidad();
				$doc_contable = MyActiveRecord :: FindFirst("Cabecera_Contabilidad","AWTYP = 'VBRK' AND AWKEY = '$this->VBELN'");
				$lin_contable = New Linea_Contabilidad();
				$lin_contable = MyActiveRecord :: FindFirst("Linea_Contabilidad","BUKRS = '$doc_contable->BUKRS' AND BELNR = '$doc_contable->BELNR' AND GJAHR = '$doc_contable->GJAHR' AND BUZEI=1 AND( BSCHL=11 OR BSCHL=01)");		
				$ind_deudores = New Deuda_CRM();
				$ind_deudores = MyActiveRecord :: FindFirst("Deuda_CRM","BUKRS = '$doc_contable->BUKRS' AND BELNR = '$doc_contable->BELNR' AND GJAHR = '$doc_contable->GJAHR'");		
				if ($doc_contable && $lin_contable){ //descomentar en un futuro y qitar la linea de abajo
					$this->DMBE2= $lin_contable->DMBE2;
					$this->FKART=$cab_factura->FKART;
					$this->BLART=$doc_contable->BLART;
					$this->DMBTR= $lin_contable->DMBTR;
					$this->BELNR=$doc_contable->BELNR;
					$this->BUKRS=$doc_contable->BUKRS;
					$this->GJAHR=$doc_contable->GJAHR;
					$this->KURRF=$cab_factura->KURRF;
					$this->WAERK=$cab_factura->WAERK;
					if ($ind_deudores->SHKZG == "H"){
						$signo= -1;
					}else{
						$signo= 1;
					}
					
					if($ind_deudores){
						$this->SABE2= $lin_contable->DMBE2*$signo;
						$this->SABTR= $lin_contable->DMBTR*$signo;
					}else{
						$this->SABE2= 0;
						$this->SABTR= 0;
					}
				    $this->XBLNR= $doc_contable->XBLNR;
					$this->KUNNR=$cab_factura->KUNRG;
					if($this->VKORG==""){//Existen documentos que nos llegan sin la organizacion de ventas, entonces se los plantamos
						switch ($lin_contable->KKBER) {
							case "ACFE":$this->VKORG="2010";break;
							case "ACFO":$this->VKORG="2020";break;
							case "ACIN":$this->VKORG="2030";break;
						}						
						$this->VTWEG="01";
					}
					
					$this->CRM_ID=$this->KUNNR.$this->VKORG;
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
					$cond = New Condicion_Pago();
					$this->ZTERM=$lin_contable->ZTERM;
					$this->FKDAT=$lin_contable->ZFBDT;
					$this->FKVEN=$cond->calcular_vencimiento($this->ZTERM, 0, $this->FKDAT);
					$this->FKREC=$cond->calcular_dia_reclamo($this->ZTERM, 0, $this->FKDAT);
					$this->DIATR=$cond->calcular_dias_atraso($this->ZTERM, 0, $this->FKDAT);
			//		$this->FKREC=$cond->calcular_dia_reclamo($this->ZTERM, 0, $this->FKDAT);
					
					parent :: save();
				}
			}else{
				$doc_contable = New Cabecera_Contabilidad();
				$doc_contable = MyActiveRecord :: FindFirst("Cabecera_Contabilidad","BUKRS = '$this->BUKRS' AND BELNR = '$this->BELNR' AND GJAHR = '$this->GJAHR'");
				$lin_contable = New Linea_Contabilidad();
				$lin_contable = MyActiveRecord :: FindFirst("Linea_Contabilidad","BUKRS = '$doc_contable->BUKRS' AND BELNR = '$doc_contable->BELNR' AND GJAHR = '$doc_contable->GJAHR' AND BUZEI=1 AND( BSCHL=11 OR BSCHL=01)");		
				$ind_deudores = New Deuda_CRM();
				$ind_deudores = MyActiveRecord :: FindFirst("Deuda_CRM","BUKRS = '$doc_contable->BUKRS' AND BELNR = '$doc_contable->BELNR' AND GJAHR = '$doc_contable->GJAHR'");		
				if ($doc_contable && $lin_contable){ //descomentar en un futuro y qitar la linea de abajo
					$this->DMBE2= $lin_contable->DMBE2;
	//				$this->FKART=$cab_factura->FKART;
					$this->BLART=$doc_contable->BLART;
					$this->DMBTR= $lin_contable->DMBTR;
					$this->BELNR=$doc_contable->BELNR;
					$this->BUKRS=$doc_contable->BUKRS;
					$this->GJAHR=$doc_contable->GJAHR;
					$this->KURRF=$doc_contable->KURSF;
					$this->WAERK=$doc_contable->WAERS;
					if ($ind_deudores->SHKZG == "H"){
						$signo= -1;
					}else{
						$signo= 1;
					}
					
					if($ind_deudores){
						$this->SABE2= $lin_contable->DMBE2*$signo;
						$this->SABTR= $lin_contable->DMBTR*$signo;
					}else{
						$this->SABE2= 0;
						$this->SABTR= 0;
					}
					if($this->VKORG==""){//Existen documentos que nos llegan sin la organizacion de ventas, entonces se los plantamos
						switch ($lin_contable->KKBER) {
							case "ACFE":$this->VKORG="2010";break;
							case "ACFO":$this->VKORG="2020";break;
							case "ACIN":$this->VKORG="2030";break;
						}						
						$this->VTWEG="01";
					}
					//			    $this->XBLNR= $doc_contable->XBLNR;
	//				$this->KUNNR=$cab_factura->KUNRG;
					$this->CRM_ID=$this->KUNNR.$this->VKORG;
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
					$cond = New Condicion_Pago();
					$this->FKDAT=$lin_contable->ZFBDT;				
					$this->ZTERM=$lin_contable->ZTERM;
					$this->FKVEN=$cond->calcular_vencimiento($lin_contable->ZTERM, 0, $lin_contable->ZFBDT);
					$this->FKREC=$cond->calcular_dia_reclamo($lin_contable->ZTERM, 0, $lin_contable->ZFBDT);
					$this->DIATR=$cond->calcular_dias_atraso($lin_contable->ZTERM, 0, $lin_contable->ZFBDT);
			//		$this->FKREC=$cond->calcular_dia_reclamo($this->ZTERM, 0, $this->FKDAT);
					
					parent :: save();
				}
			}
		}
	}
	
	
};
?>

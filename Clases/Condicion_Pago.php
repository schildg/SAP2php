<?php
include_once('DATA_CONF.php');
class Condicion_Pago extends SuperClase{
	function Condicion_Pago() {
		$this->CLASE_OBJETO='Condicion_Pago';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","ZTERM" => "Clave de condiciones de pago","ZTAGG" => "Día límite","ZDART" => "Clase de fecha","ZFAEL" => "Día natural para fecha base de plazo de pago","ZMONA" => "Meses adicionales","ZTAG1" => "Días a partir de fecha base para plazo de pago","ZPRZ1" => "Porcentaje descuento","ZTAG2" => "Días a partir de fecha base para plazo de pago","ZPRZ2" => "Porcentaje descuento","ZTAG3" => "Días a partir de fecha base para plazo de pago","ZSTG1" => "Día de vencimiento de la condición especial","ZSMN1" => "Meses adicionales para condición especial (requisi","ZSTG2" => "Día de vencimiento de la condición especial","ZSMN2" => "Meses adicionales para condición especial (requisi","ZSTG3" => "Día de vencimiento de la condición especial","ZSMN3" => "Meses adicionales para condición especial (requisi","XZBRV" => "Impresión de condiciones de pago en documentos SD","ZSCHF" => "Bloqueo de pago (valor de propuesta)","XCHPB" => "¿Desea transferir bloqueo pago al modificar cond.p","TXN08" => "Número del texto estándar","ZLSCH" => "Vía de pago","XCHPM" => "¿Desea transferir vía de pago al modificar cond.pa","KOART" => "Clase de cuenta de la empresa colaboradora","XSPLT" => "Indicador: Condición para pago a plazos","XSCRC" => "Contab.periódicas: Adaptar cond.pago de registro m",
                     );
        return $Campo[$campo];
	}
	function buscarExtendido($vZTERM,$vZTAGG) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"ZTERM = '$vZTERM' AND ZTAGG = '$vZTAGG'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	function calcular_dias_atraso($vZTERM,$vZTAGG,$fecha_base) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"ZTERM = '$vZTERM' AND ZTAGG = '$vZTAGG'");
		if (!$rela){
			$dias=0;
		}else{
			$dias=$rela->ZTAG1;
		};
		$str_anio=substr($fecha_base,0,4);
		$str_mes=substr($fecha_base,4,2);
		$str_dia=substr($fecha_base,6,2);
		$timestamp1 = mktime(0, 0, 0, (int)$str_mes,(int)$str_dia, (int)$str_anio) + ( $dias * 60 * 60 * 24);
		$timestamp_hoy = mktime(0, 0, 0,  date("m"), date("d"), date("Y"));
		$dias_diferencia = ($timestamp_hoy - $timestamp1) / ( 60 * 60 * 24);
		return round($dias_diferencia,0);
		
	}
	function calcular_vencimiento($vZTERM,$vZTAGG,$fecha_base) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"ZTERM = '$vZTERM' AND ZTAGG = '$vZTAGG'");
		if (!$rela){
			return false;
		}else{
			$str_anio=substr($fecha_base,0,4);
			$str_mes=substr($fecha_base,4,2);
			$str_dia=substr($fecha_base,6,2);
			$timestamp1 = mktime(0, 0, 0, (int)$str_mes,(int)$str_dia, (int)$str_anio) + ( $rela->ZTAG1 * 60 * 60 * 24);
			return date("Ymd",$timestamp1);
		};
		
	}
	function calcular_dia_reclamo($vZTERM,$vZTAGG,$fecha_base) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"ZTERM = '$vZTERM' AND ZTAGG = '$vZTAGG'");
		if (!$rela){
			return false;
		}else{
			$str_anio=substr($fecha_base,0,4);
			$str_mes=substr($fecha_base,4,2);
			$str_dia=substr($fecha_base,6,2);
			$timestamp1 = mktime(0, 0, 0, (int)$str_mes,(int)$str_dia, (int)$str_anio) + ( $rela->dia_reclamo * 60 * 60 * 24);
			if(date("w",$timestamp1)==0){
				$timestamp1 = mktime(0, 0, 0, (int)$str_mes,(int)$str_dia, (int)$str_anio) + ( $rela->dia_reclamo * 60 * 60 * 24) -(2 * 60 * 60 * 24); //fecha base + dias de reclamos -2 dias por domingo			
			}else{
				if(date("w",$timestamp1)==6){
					$timestamp1 = mktime(0, 0, 0, (int)$str_mes,(int)$str_dia, (int)$str_anio) + ( $rela->dia_reclamo * 60 * 60 * 24) -(1 * 60 * 60 * 24); //fecha base + dias de reclamos -1 dias por sabado			
				} 			
			} 
			return date("Ymd",$timestamp1);
		};
		
	}
		
};
?>

<?php
include_once('DATA_CONF.php');
class Out_EmHu_OrdFab extends SuperClase{
	function Out_EmHu_OrdFab() {
		$this->CLASE_OBJETO='Out_EmHu_OrdFab';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","AUFNR" => "Número de orden","tarea" => "Numero de tarea","MATNRHU" => "Número de material","QUANTITY" => "Cantidad base embalada en posición de unidad manip","MEINS" => "Unidad de medida base","BUDAT" => "Fecha de contabilización en el documento","ELIKZ" => "Indicador de entrega final",
                     );
        return $Campo[$campo];
	}
	function buscarExtendido($vAUFNR,$vTarea) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"AUFNR  = '$vAUFNR' AND tarea='$vTarea'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	
};
?>

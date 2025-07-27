<?php
include_once('DATA_CONF.php');
class Clase_Movimiento extends SuperClase{
	function Clase_Movimiento() {
		$this->CLASE_OBJETO='Clase_Movimiento';
	}
	function leyenda() {
		return $this->clase_movimiento." - ".$this->nombre;
	}
	function signo($clas_mov) {
		$cm = MyActiveRecord :: FindFirst($this->CLASE_OBJETO, "clase_movimiento = '$clas_mov'");
		return $cm->signo_para_anita;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","clase_movimiento" => "clase_movimiento","nombre" => "nombre","signo_para_anita" => "signo_para_anita",
                     );
        return $Campo[$campo];
	}
};
?>

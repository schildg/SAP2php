<?php
include_once('DATA_CONF.php');
class Accion extends SuperClase {
	function buscarAccion($comando) {
		return MyActiveRecord :: FindFirst('Accion', "comando = '$comando' AND habilitado > 0 ");
	}
	function Accion() {
		$this->CLASE_OBJETO='Accion';
	}
	function modulo($comando) {
		$accion= MyActiveRecord :: FindFirst('Accion', "comando = '$comando' AND habilitado > 0 ");
		return $accion->modulo;
	}
	function leyenda() {
		return $this->id." - ".$this->comando."; ".$this->modulo;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id",
                     "rotulo" => "Rotulo",
                     "habilitado" => "Habilitado",
                     "comando" => "Accion",
                     "modulo" => "Modulo",
                     "fecha" => "fecha",
                     "descripcion" => "Descripcion",
                     );
        return $Campo[$campo];
	}
}
?>

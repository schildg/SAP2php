<?php
include_once('DATA_CONF.php');
class Attach extends SuperClase {
	function Attach() {
		$this->CLASE_OBJETO='Attach';
	}
	function tieneAttach($objeto,$objeto_id) {
		$rela= MyActiveRecord :: FindFirst('Attach', "objeto_id = '$objeto_id' AND objeto= '$objeto'");
		if (!$rela){return false;}else{return true;};
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id",
                     "attach" => "attach",
                     "thumb" => "thumb",
                     "objeto" => "Objeto",
                     "objeto_id" => "id del Objeto",
                     "nombre" => "Descripcion",
                     "mime" => "mime",
                     "tmp_name" => "Nombre Temporal",
                     );
        return $Campo[$campo];
	}
};
?>

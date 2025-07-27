<?php
include_once('DATA_CONF.php');
class At_Mov extends SuperClase{
	function At_Mov() {
		$this->CLASE_OBJETO='At_Mov';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","cmov_lu" => "cmov_lu","nmov_lu" => "nmov_lu","AUFNR" => "AUFNR","EXIDV_OB" => "EXIDV_OB","estado" => "estado","MBLNR" => "MBLNR","MJAH" => "MJAH",
                     );
        return $Campo[$campo];
	}
};
?>

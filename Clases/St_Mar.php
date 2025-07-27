<?php
include_once('DATA_CONF.php');
include_once('St_Art.php');
class St_Mar extends SuperClase{
	function St_Mar() {
		$this->CLASE_OBJETO='St_Mar';
	}
	function leyenda() {
		return $this->marc_sm." - ".$this->desc_sm;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","desc_sm" => "DESCRIPCION LARGA DE LA MARCA","marc_sm" => "CODIGO DE LA MARCA","deco_sm" => "DESCRIPCION CORTA DE LA MARCA","habi_sm" => "HABILITACION","impo_sm" => "Origen","fill_sm" => "VACIO",
                     );
        return $Campo[$campo];
	}
};
?>

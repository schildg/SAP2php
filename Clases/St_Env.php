<?php
include_once('DATA_CONF.php');
class St_Env extends SuperClase{
	function St_Env() {
		$this->CLASE_OBJETO='St_Env';
	}
	function leyenda() {
		return $this->enva_se." - ".$this->desc_se;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","desc_se" => "Descripcion larga del envase","enva_se" => "Codigo del envase (una letra)","deco_se" => "Descripcion corta del envase","habi_se" => "Habilitacion","ncen_se" => "Nombre correcto del Envase","fill_se" => "Libre para usos futuros",
                     );
        return $Campo[$campo];
	}
};
?>

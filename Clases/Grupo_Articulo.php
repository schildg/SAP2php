<?php
include_once('DATA_CONF.php');
class Grupo_Articulo extends SuperClase{
	function Grupo_Articulo() {
		$this->CLASE_OBJETO='Grupo_Articulo';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","SPRAS" => "Clave de idioma","MATKL" => "Grupo de art�culos","WGBEZ" => "Denominaci�n del grupo de art�culos","WGBEZ60" => "Texto explicativo p.denominar gr.art�culos",
                     );
        return $Campo[$campo];
	}
};
?>

<?php
include_once('DATA_CONF.php');
class Diccionario extends SuperClase{
	function Diccionario() {
		$this->CLASE_OBJETO='Diccionario';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id",
                     "objeto" => "Objeto",
                     "campo" => "Campo",
                     "objeto_foraneo" => "Objeto Foraneo",
                     "campo_foraneo" => "Campo Foraneo",
                     "es_foraneo" => "Es Foraneo",
                     "gene_historia" => "Genera Historia",
                     "leye_historia" => "Leyende de Historia",
                     "es_unico" => "Es Unico",
                     "leyenda" => "Leyenda",
                     "descripcion" => "Descripcion",
                     "ayuda" => "Ayuda",
                     );
        return $Campo[$campo];
	}
};
?>

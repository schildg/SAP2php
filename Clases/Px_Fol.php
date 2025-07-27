<?php
include_once('DATA_CONF.php');
class Px_Fol extends SuperClase{
	function Px_Fol() {
		$this->CLASE_OBJETO='Px_Fol';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","prod_ll" => "Producto","cmov_ll" => "Codigo documento","nmov_ll" => "Numero de documento","item_ll" => "Item","site_ll" => "Sub Item","cant_ll" => "Cantidad","orde_ll" => "Numero de orden obligatorio","agma_ll" => "Agregado manual obligatorio","micr_ll" => "Micromezclar","epex_ll" => "Lleva estiramiento previo con excipiente","epec_ll" => "Cantidad de excipiente par estirar","fill_ll" => "LIBRE PARA USO FUTURO",
                     );
        return $Campo[$campo];
	}
};
?>

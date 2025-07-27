<?php
include_once('DATA_CONF.php');
class Accion_Menu extends SuperClase {
	function Accion_Menu() {
		$this->CLASE_OBJETO='Accion_Menu';
	}
	function buscarAcciones($id) {
		return MyActiveRecord :: FindAll('Accion_Menu', "menu_id = '$id' and habilitado = 1");
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id",
                     "menu_id" => "Menu Raiz",
                     "habilitado" => "Habilitado",
                     "accion_id" => "Accion",
                     );
        return $Campo[$campo];
	}
};
?>

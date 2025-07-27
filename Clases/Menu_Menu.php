<?php
include_once('DATA_CONF.php');
class Menu_Menu extends SuperClase {
	function Menu_Menu() {
		$this->CLASE_OBJETO='Menu_Menu';
	}
	function buscarSubmenu($id) {
		return MyActiveRecord :: FindAll('Menu_Menu', "menu_id = '$id' and habilitado = 1");
	}
	function menu() {
		$aCcion = MyActiveRecord :: FindFirst('Accion', "id = '$this->accion_id'");
		return $aCcion->comando;
	}
	function menuRotulo() {
		$aCcion = MyActiveRecord :: FindFirst('Accion', "id = '$this->accion_id'");
		return $aCcion->rotulo;
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id",
                     "menu_id" => "Menu Raiz",
                     "habilitado" => "Habilitado",
                     "menu_id1" => "Sub Menu",
                     );
        return $Campo[$campo];
	}
};
?>

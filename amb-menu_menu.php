<?php
include_once ("Clases/Menu_Menu.php");
include_once ("Clases/AMB.php");
$menu_menu = new Menu_Menu();
$OBJETO = 'Menu_Menu';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Menu_Menu');
$CAMPOS = array('id','menu_id','menu_id1','habilitado');
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los Submenues');
$amb->cargarTituloObjeto('un Submenu en un menu');
switch ($accion) {
	case "editar$SUBOBJETO" :
		include_once ("editarObjeto.php");
		break;
	case "borrar$SUBOBJETO" :
		include_once ("borrarObjeto.php");
		break;
	case "alta$SUBOBJETO" :
		include_once ("altaObjeto.php");
		break;
	case $SUBOBJETO :
		include_once ("accionObjeto.php");
		include_once ("accionObjetoGuardar.php");
		break;
};

?>
<?php
include_once ("Clases/Menu.php");
include_once ("Clases/AMB.php");
$menu = new Menu();
$OBJETO = 'Menu';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Menu');
$CAMPOS = array('id','tipo_menu','denominacion','habilitado');
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los Menues');
$amb->cargarTituloObjeto('un Menu');
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
<?php
include_once ("Clases/Accion_Menu.php");
include_once ("Clases/AMB.php");
$amb = new AMB('Accion_Menu');
$accion_menu = new Accion_Menu();
$OBJETO = 'Accion_Menu';
$SUBOBJETO=$OBJETO;
$CAMPOS=array('id','menu_id','accion_id','habilitado');
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de la relacion Accion Menu');
$amb->cargarTituloObjeto('Acciones en un Menu');
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
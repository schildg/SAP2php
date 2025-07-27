<?php
include_once ("Clases/Tabla.php");
include_once ("Clases/AMB.php");
$tabla = new Tabla();
$OBJETO = 'Tabla';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Tabla');
$CAMPOS = array('id','campo','numero','habilitado','nombre','noco','objeto');
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los valores de una Tabla');
$amb->cargarTituloObjeto('la relacion de una tabla');
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
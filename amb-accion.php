<?php
include_once ("Clases/Accion.php");
include_once ("Clases/AMB.php");
$aCcion = new Accion();
$OBJETO = 'Accion';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Accion');
$CAMPOS = array('id','comando','descripcion','fecha','habilitado','modulo','rotulo');
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de la relacion Accion');
$amb->cargarTituloObjeto('una Accion');
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
	case $OBJETO :
		include_once ("accionObjeto.php");
		include_once ("accionObjetoGuardar.php");
		break;
};


?>
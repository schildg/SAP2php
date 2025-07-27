<?php
include_once ("Clases/Establecimiento.php");
include_once ("Clases/AMB.php");
$establecimiento = new Establecimiento();
$OBJETO = 'Establecimiento';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Establecimiento');
$CAMPOS = array('id','nombre','nombre_abreviado','direccion','tipo','nivel','localidad_id','logo_1','logo_2','img_izq','img_der');
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Establecimiento');
$amb->cargarTituloObjeto('un Establecimiento');
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
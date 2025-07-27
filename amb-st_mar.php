<?php
include_once ("Clases/St_Mar.php");
include_once ("Clases/AMB.php");
$st_mar = new St_Mar();
$OBJETO = 'St_Mar';
$SUBOBJETO=$OBJETO;
$amb = new AMB('St_Mar');
$CAMPOS = array('id','desc_sm','marc_sm','deco_sm','habi_sm','impo_sm');
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el St_Mar');
$amb->cargarTituloObjeto('un St_Mar');
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
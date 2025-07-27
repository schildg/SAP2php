<?php
include_once ("Clases/Attach.php");
include_once ("Clases/AMB.php");
$attach = new Attach();
$OBJETO = 'Attach';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Attach');
$CAMPOS = array('id','objeto','objeto_id','mime','nombre','tmp_name');
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los Attach del Objeto');
$amb->cargarTituloObjeto('un Attach');
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
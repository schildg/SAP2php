<?php
include_once ("Clases/LineaMovimientoMaterial.php");
include_once ("Clases/AMB.php");
$lineamovimientomaterial = new LineaMovimientoMaterial();
$OBJETO = 'LineaMovimientoMaterial';
$SUBOBJETO=$OBJETO;
$amb = new AMB('LineaMovimientoMaterial');
$CAMPOS = array('id','MAT_DOC','DOC_YEAR','MOVE_TYPE','VEMNG','VEMEH','MATNR',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el LineaMovimientoMaterial');
$amb->cargarTituloObjeto('un LineaMovimientoMaterial');
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
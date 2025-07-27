<?php
include_once ("Clases/HUMovimientoMaterial.php");
include_once ("Clases/AMB.php");
$humovimientomaterial = new HUMovimientoMaterial();
$OBJETO = 'HUMovimientoMaterial';
$SUBOBJETO=$OBJETO;
$amb = new AMB('HUMovimientoMaterial');
$CAMPOS = array('id','MAT_DOC','DOC_YEAR','MATNR','CHARG','EXIDV','VEMNG','VEMEH',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el HUMovimientoMaterial');
$amb->cargarTituloObjeto('un HUMovimientoMaterial');
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
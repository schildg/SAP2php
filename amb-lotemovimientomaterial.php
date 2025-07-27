<?php
include_once ("Clases/LoteMovimientoMaterial.php");
include_once ("Clases/AMB.php");
$lotemovimientomaterial = new LoteMovimientoMaterial();
$OBJETO = 'LoteMovimientoMaterial';
$SUBOBJETO=$OBJETO;
$amb = new AMB('LoteMovimientoMaterial');
$CAMPOS = array('id','MAT_DOC','DOC_YEAR','MATNR','CHARG','VEMNG','VEMEH','VFDAT',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el LoteMovimientoMaterial');
$amb->cargarTituloObjeto('un LoteMovimientoMaterial');
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
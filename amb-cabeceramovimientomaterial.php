<?php
include_once ("Clases/CabeceraMovimientoMaterial.php");
include_once ("Clases/AMB.php");
$cabeceramovimientomaterial = new CabeceraMovimientoMaterial();
$OBJETO = 'CabeceraMovimientoMaterial';
$SUBOBJETO=$OBJETO;
$amb = new AMB('CabeceraMovimientoMaterial');
$CAMPOS = array('id','MAT_DOC','DOC_YEAR','TR_EV_TYPE','PSTNG_DATE','REF_DOC_NO','VBELN','WERKS','LGORT','WDATU',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el CabeceraMovimientoMaterial');
$amb->cargarTituloObjeto('un CabeceraMovimientoMaterial');
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
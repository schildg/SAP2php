<?php
include_once ("Clases/ListaMovimientoMateriales.php");
include_once ("Clases/AMB.php");
$listamovimientomateriales = new ListaMovimientoMateriales();
$OBJETO = 'ListaMovimientoMateriales';
$SUBOBJETO=$OBJETO;
$amb = new AMB('ListaMovimientoMateriales');
$CAMPOS = array('id','MAT_DOC','DOC_YEAR','TR_EV_TYPE','PSTNG_DATE','REF_DOC_NO','EXIDV','VENUM','VBELN','POSNR','UNVEL','VEMNG','VEMEH','MATNR','CHARG','WERKS','LGORT','WDATU','VFDAT','HU_LGORT','XCHAR',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el ListaMovimientoMateriales');
$amb->cargarTituloObjeto('un ListaMovimientoMateriales');
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
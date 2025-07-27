<?php
include_once ("Clases/Out_GoodsMvment.php");
include_once ("Clases/AMB.php");
$out_goodsmvment = new Out_GoodsMvment();
$OBJETO = 'Out_GoodsMvment';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Out_GoodsMvment');
$CAMPOS = array('id','AUFNR','MATNR','TEXT_MSEG_MATNR','WERKS','CHARG','LGORT','BWART','MJAHR','MBLNR','MENGE','MEINS','EXIDV','VENUM',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Out_GoodsMvment');
$amb->cargarTituloObjeto('un Out_GoodsMvment');
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
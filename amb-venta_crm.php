<?php
include_once ("Clases/Venta_CRM.php");
include_once ("Clases/AMB.php");
$venta_crm = new Venta_CRM();
$OBJETO = 'Venta_CRM';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Venta_CRM');
$CAMPOS = array('id','KUNNR','MATNR','KUNN2','VKORG','WAERK','ZTERM','BSARK','AUART','WERKS','LGORT','PRCTR','VKGRP','VKBUR','XBLNR','VBELN','ERDAT','PU_ML','PU_USD','NETPR','NETPR_USD','CU_ML','CU_USD','WAVWR','WAVWR_USD','ZMENG','ZIEME','STCUR','BSTNK','MEINS','VRKME',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Venta_CRM');
$amb->cargarTituloObjeto('un Venta_CRM');
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
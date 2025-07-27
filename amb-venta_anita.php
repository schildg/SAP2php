<?php
include_once ("Clases/Venta_Anita.php");
include_once ("Clases/AMB.php");
$venta_anita = new Venta_Anita();
$OBJETO = 'Venta_Anita';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Venta_Anita');
$CAMPOS = array('id','CRM_ID','KUNNR','MATNR','KUNN2','VKORG','UNNEG','WAERK','ZTERM','BSARK','AUART','WERKS','LGORT','PRCTR','VKGRP','VKBUR','XBLNR','VBELN','POSNR','ERDAT','PU_ML','PU_USD','NETPR','NETPR_USD','CU_ML','CU_USD','WAVWR','WAVWR_USD','ZMENG','ZIEME','STCUR','BSTNK','MEINS','VRKME','HB_EXPDATE','BUKRS','FKART','KKBER','DOCFI','GJAHR','BLART','SHKZG','ZFBDT','PERIO',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Venta_Anita');
$amb->cargarTituloObjeto('un Venta_Anita');
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
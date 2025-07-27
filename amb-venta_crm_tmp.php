<?php
include_once ("Clases/Venta_CRM_TMP.php");
include_once ("Clases/AMB.php");
$venta_crm_tmp = new Venta_CRM_TMP();
$OBJETO = 'Venta_CRM_TMP';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Venta_CRM_TMP');
$CAMPOS = array('id','CRM_ID','KUNNR','MATNR','KUNN2','VKORG','UNNEG','WAERK','ZTERM','BSARK','AUART','WERKS','LGORT','PRCTR','VKGRP','VKBUR','XBLNR','VBELN','POSNR','ERDAT','PU_ML','PU_USD','NETPR','NETPR_USD','CU_ML','CU_USD','WAVWR','WAVWR_USD','ZMENG','ZIEME','STCUR','BSTNK','MEINS','VRKME','HB_EXPDATE','BUKRS','FKART','KKBER','DOCFI','GJAHR','BLART','SHKZG','ZFBDT','PERIO',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Venta_CRM_TMP');
$amb->cargarTituloObjeto('un Venta_CRM_TMP');
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
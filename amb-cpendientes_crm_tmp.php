<?php
include_once ("Clases/CPendientes_CRM_TMP.php");
include_once ("Clases/AMB.php");
$cpendientes_crm_tmp = new CPendientes_CRM_TMP();
$OBJETO = 'CPendientes_CRM_TMP';
$SUBOBJETO=$OBJETO;
$amb = new AMB('CPendientes_CRM_TMP');
$CAMPOS = array('id','BUKRS','EBELN','EBELP','EKORG','EKGRP','BSART','AEDAT','EEIND','LIFNR','MATNR','WERKS','LGORT','MENGE','MEINS','WAERS','WKURS','CU_PESO','CU_DOLAR','COSTO_PESO','COSTO_DOLAR','COSTO_NAC_PESO','COSTO_NAC_DOLAR','ESTADO',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el CPendientes_CRM_TMP');
$amb->cargarTituloObjeto('un CPendientes_CRM_TMP');
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
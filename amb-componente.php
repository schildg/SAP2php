<?php
include_once ("Clases/Componente.php");
include_once ("Clases/AMB.php");
$componente = new Componente();
$OBJETO = 'Componente';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Componente');
$CAMPOS = array('id','RESERVATION_NUMBER','RESERVATION_ITEM','RESERVATION_TYPE','DELETION_INDICATOR','MATERIAL','PROD_PLANT','STORAGE_LOCATION','SUPPLY_AREA','BATCH','SPECIAL_STOCK','REQ_DATE','REQ_QUAN','BASE_UOM','BASE_UOM_ISO','WITHDRAWN_QUANTITY','ENTRY_QUANTITY','ENTRY_UOM','ENTRY_UOM_ISO','ORDER_NUMBER','MOVEMENT_TYPE','ITEM_CATEGORY','ITEM_NUMBER','SEQUENCE','OPERATION','BACKFLUSH','VALUATION_SPEC_STOCK','SYSTEM_STATUS','MATERIAL_DESCRIPTION','COMMITED_QUANTITY','SHORTAGE','PURCHASE_REQ_NO','PURCHASE_REQ_ITEM','MATERIAL_EXTERNAL','MATERIAL_GUID','MATERIAL_VERSION',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Componente');
$amb->cargarTituloObjeto('un Componente');
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
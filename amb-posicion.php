<?php
include_once ("Clases/Posicion.php");
include_once ("Clases/AMB.php");
$posicion = new Posicion();
$OBJETO = 'Posicion';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Posicion');
$CAMPOS = array('id','ORDER_NUMBER','ORDER_ITEM_NUMBER','SALES_ORDER','SALES_ORDER_ITEM','SCRAP','QUANTITY','DELIVERED_QUANTITY','BASE_UNIT','BASE_UNIT_ISO','MATERIAL','ACTUAL_DELIVERY_DATE','PLANNED_DELIVERY_DATE','PLAN_PLANT','STORAGE_LOCATION','DELIVERY_COMPL','PRODUCTION_VERSION','PROD_PLANT','ORDER_TYPE','FINISH_DATE','PRODUCTION_FINISH_DATE','BATCH','DELETION_FLAG','MRP_AREA','MATERIAL_TEXT','MATERIAL_EXTERNAL','MATERIAL_GUID','MATERIAL_VERSION',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Posicion');
$amb->cargarTituloObjeto('un Posicion');
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
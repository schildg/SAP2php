<?php
include_once ("Clases/OrdenProduccion.php");
include_once ("Clases/AMB.php");
$ordenproduccion = new OrdenProduccion();
$OBJETO = 'OrdenProduccion';
$SUBOBJETO=$OBJETO;
$amb = new AMB('OrdenProduccion');
$CAMPOS = array('id','ORDER_NUMBER','PRODUCTION_PLANT','MRP_CONTROLLER','PRODUCTION_SCHEDULER','MATERIAL','EXPL_DATE','ROUTING_NO','RESERVATION_NUMBER','SCHED_RELEASE_DATE','ACTUAL_RELEASE_DATE','FINISH_DATE','START_DATE','PRODUCTION_FINISH_DATE','PRODUCTION_START_DATE','ACTUAL_START_DATE','ACTUAL_FINISH_DATE','SCRAP','TARGET_QUANTITY','UNIT','UNIT_ISO','PRIORITY','ORDER_TYPE','ENTERED_BY','ENTER_DATE','DELETION_FLAG','WBS_ELEMENT','CONF_NO','CONF_CNT','INT_OBJ_NO','SCHED_FIN_TIME','SCHED_START_TIME','COLLECTIVE_ORDER','ORDER_SEQ_NO','FINISH_TIME','START_TIME','ACTUAL_START_TIME','LEADING_ORDER','SALES_ORDER','SALES_ORDER_ITEM','PROD_SCHED_PROFILE','MATERIAL_TEXT','SYSTEM_STATUS','CONFIRMED_QUANTITY','PLAN_PLANT','BATCH','MATERIAL_EXTERNAL','MATERIAL_GUID','MATERIAL_VERSION','DATE_OF_EXPIRY','DATE_OF_MANUFACTURE','STLNR');
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el OrdenProduccion');
$amb->cargarTituloObjeto('un OrdenProduccion');
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
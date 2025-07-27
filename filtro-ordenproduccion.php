<?php
include_once ("Clases/OrdenProduccion.php");
$smarty = new Smarty();
$ordenproduccion = new OrdenProduccion();
$OBJETO = 'OrdenProduccion';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','ORDER_NUMBER','PRODUCTION_PLANT','MRP_CONTROLLER','PRODUCTION_SCHEDULER','MATERIAL','EXPL_DATE','ROUTING_NO','RESERVATION_NUMBER','SCHED_RELEASE_DATE','ACTUAL_RELEASE_DATE','FINISH_DATE','START_DATE','PRODUCTION_FINISH_DATE','PRODUCTION_START_DATE','ACTUAL_START_DATE','ACTUAL_FINISH_DATE','SCRAP','TARGET_QUANTITY','UNIT','UNIT_ISO','PRIORITY','ORDER_TYPE','ENTERED_BY','ENTER_DATE','DELETION_FLAG','WBS_ELEMENT','CONF_NO','CONF_CNT','INT_OBJ_NO','SCHED_FIN_TIME','SCHED_START_TIME','COLLECTIVE_ORDER','ORDER_SEQ_NO','FINISH_TIME','START_TIME','ACTUAL_START_TIME','LEADING_ORDER','SALES_ORDER','SALES_ORDER_ITEM','PROD_SCHED_PROFILE','MATERIAL_TEXT','SYSTEM_STATUS','CONFIRMED_QUANTITY','PLAN_PLANT','BATCH','MATERIAL_EXTERNAL','MATERIAL_GUID','MATERIAL_VERSION','DATE_OF_EXPIRY','DATE_OF_MANUFACTURE','STLNR');

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del ordenproduccion");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aOrdenProduccions = $ordenproduccion->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aOrdenProduccions);

$smarty->display('ListadorDeDatos.tpl');
?>
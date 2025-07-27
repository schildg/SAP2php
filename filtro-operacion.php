<?php
include_once ("Clases/Operacion.php");
$smarty = new Smarty();
$operacion = new Operacion();
$OBJETO = 'Operacion';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','AUFNR','ROUTING_NO','COUNTER','SEQUENCE_NO','CONF_NO','CONF_CNT','PURCHASE_REQ_NO','PURCHASE_REQ_ITEM','GROUP_COUNTER','TASK_LIST_TYPE','TASK_LIST_GROUP','OPERATION_NUMBER','OPR_CNTRL_KEY','PROD_PLANT','DESCRIPTION','DESCRIPTION2','STANDARD_VALUE_KEY','ACTIVITY_TYPE_1','ACTIVITY_TYPE_2','ACTIVITY_TYPE_3','ACTIVITY_TYPE_4','ACTIVITY_TYPE_5','ACTIVITY_TYPE_6','UNIT','UNIT_ISO','QUANTITY','SCRAP','EARL_SCHED_START_DATE_EXEC','EARL_SCHED_START_TIME_EXEC','EARL_SCHED_START_DATE_PROC','EARL_SCHED_START_TIME_PROC','EARL_SCHED_START_DATE_TEARD','EARL_SCHED_START_TIME_TEARD','EARL_SCHED_FIN_DATE_EXEC','EARL_SCHED_FIN_TIME_EXEC','LATE_SCHED_START_DATE_EXEC','LATE_SCHED_START_TIME_EXEC','LATE_SCHED_START_DATE_PROC','LATE_SCHED_START_TIME_PROC','LATE_SCHED_START_DATE_TEARD','LATE_SCHED_START_TIME_TEARD','LATE_SCHED_FIN_DATE_EXEC','LATE_SCHED_FIN_TIME_EXEC','WORK_CENTER','WORK_CENTER_TEXT','SYSTEM_STATUS','SUBOPERATION',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del operacion");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aOperacions = $operacion->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aOperacions);

$smarty->display('ListadorDeDatos.tpl');
?>
<?php
include_once ("Clases/PPendiente_CRM_TODO.php");
$smarty = new Smarty();
$ppendiente_crm_todo = new PPendiente_CRM_TODO();
$OBJETO = 'PPendiente_CRM_TODO';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','BUKRS','CRM_ID','AUART','VBELN','POSNR','VKORG','VTWEG','AUDAT','VDATU','KUNNR','KUNN2','LAND1','MATNR','WERKS','LGORT','KWMENG','ZIEME','WAERK','STCUR','TOTAL_PESO','TOTAL_DOLAR','PRECIO_PESO','PRECIO_DOLAR','RFSTA',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del ppendiente_crm_todo");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aPPendiente_CRM_TODOs = $ppendiente_crm_todo->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aPPendiente_CRM_TODOs);

$smarty->display('ListadorDeDatos.tpl');
?>
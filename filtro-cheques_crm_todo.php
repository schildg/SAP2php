<?php
include_once ("Clases/Cheques_CRM_TODO.php");
$smarty = new Smarty();
$cheques_crm_todo = new Cheques_CRM_TODO();
$OBJETO = 'Cheques_CRM_TODO';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','CRM_ID','BUKRS','NCHCK','BLDAT','BELNR','GJAHR','BUZEI','FEEMI','FEVEN','TPCHK','INDDF','BANK','SUCU','POST','LOCA','CHCKR','WAERS','WRBTR','CTAB','CART','CLAU','EMIS','KUNNR','PRCTR','SEGMT','LOTE','ESTAD','KKBER','SEL','DMBE2',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del cheques_crm_todo");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aCheques_CRM_TODOs = $cheques_crm_todo->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aCheques_CRM_TODOs);

$smarty->display('ListadorDeDatos.tpl');
?>
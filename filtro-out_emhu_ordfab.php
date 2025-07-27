<?php
include_once ("Clases/Out_EmHu_OrdFab.php");
$smarty = new Smarty();
$out_emhu_ordfab = new Out_EmHu_OrdFab();
$OBJETO = 'Out_EmHu_OrdFab';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','AUFNR','tarea','MATNRHU','QUANTITY','MEINS','BUDAT','ELIKZ',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del out_emhu_ordfab");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aOut_EmHu_OrdFabs = $out_emhu_ordfab->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aOut_EmHu_OrdFabs);

$smarty->display('ListadorDeDatos.tpl');
?>
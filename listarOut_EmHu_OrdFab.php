<?php
include_once ("Clases/Out_EmHu_OrdFab.php");
$out_emhu_ordfab = new Out_EmHu_OrdFab();

$OBJETO='Out_EmHu_OrdFab';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','AUFNR','tarea','MATNRHU','QUANTITY',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $out_emhu_ordfab);

$aOut_EmHu_OrdFabs = $out_emhu_ordfab->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aOut_EmHu_OrdFabs);

$smarty->assign("titulo", "Listado del Out_EmHu_OrdFab");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
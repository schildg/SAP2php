<?php
include_once ("Clases/Attach.php");
$smarty = new Smarty();
$attach = new Attach();
$OBJETO = 'Attach';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','objeto','objeto_id','mime','nombre','tmp_name');

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los Attachs");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aAttachs = $attach->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aAttachs);

$smarty->display('ListadorDeDatos.tpl');
?>
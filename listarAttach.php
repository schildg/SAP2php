<?php
include_once ("Clases/Attach.php");
$attach = new Attach();

$OBJETO='Attach';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','objeto','objeto_id','mime','nombre','tmp_name');

include_once ("datos-listador.php");

$smarty->assign("objeto", $attach);

$aAttachs = $attach->FindAll($OBJETO,$sql,$ORDEN);

$smarty->assign("listaObjetos", $aAttachs);

$smarty->assign("titulo", "Listado de Attach");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
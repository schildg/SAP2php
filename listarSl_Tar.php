<?php
include_once ("Clases/Sl_Tar.php");
$sl_tar = new Sl_Tar();

$OBJETO='Sl_Tar';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','cdoc_lt','ndoc_lt','item_lt','esta_lt',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $sl_tar);

$aSl_Tars = $sl_tar->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aSl_Tars);

$smarty->assign("titulo", "Listado del Sl_Tar");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
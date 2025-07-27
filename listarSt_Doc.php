<?php
include_once ("Clases/St_Doc.php");
$st_doc = new St_Doc();

$OBJETO='St_Doc';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','esta_sd','clie_sd','fech_sd','cmov_sd',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $st_doc);

$aSt_Docs = $st_doc->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aSt_Docs);

$smarty->assign("titulo", "Listado del St_Doc");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
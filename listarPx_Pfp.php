<?php
include_once ("Clases/Px_Pfp.php");
$px_pfp = new Px_Pfp();

$OBJETO='Px_Pfp';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','pend_lq','ftur_lq','htur_lq','orde_lq',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $px_pfp);

$aPx_Pfps = $px_pfp->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aPx_Pfps);

$smarty->assign("titulo", "Listado del Px_Pfp");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
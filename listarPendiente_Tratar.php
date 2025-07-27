<?php
include_once ("Clases/Pendiente_Tratar.php");
$pendiente_tratar = new Pendiente_Tratar();

$OBJETO='Pendiente_Tratar';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','objeto','id_objeto','estado','codigo',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $pendiente_tratar);

$aPendiente_Tratars = $pendiente_tratar->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aPendiente_Tratars);

$smarty->assign("titulo", "Listado del Pendiente_Tratar");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
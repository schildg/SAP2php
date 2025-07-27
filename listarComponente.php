<?php
include_once ("Clases/Componente.php");
$componente = new Componente();

$OBJETO='Componente';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','RESERVATION_NUMBER','RESERVATION_ITEM','RESERVATION_TYPE','DELETION_INDICATOR',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $componente);

$aComponentes = $componente->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aComponentes);

$smarty->assign("titulo", "Listado del Componente");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
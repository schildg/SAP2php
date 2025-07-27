<?php
include_once ("Clases/Posicion.php");
$posicion = new Posicion();

$OBJETO='Posicion';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','ORDER_NUMBER','ORDER_ITEM_NUMBER','SALES_ORDER','SALES_ORDER_ITEM',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $posicion);

$aPosicions = $posicion->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aPosicions);

$smarty->assign("titulo", "Listado del Posicion");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
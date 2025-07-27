<?php
include_once ("Clases/Condicion_Pago.php");
$condicion_pago = new Condicion_Pago();

$OBJETO='Condicion_Pago';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','ZTERM','ZTAGG','ZDART','ZFAEL',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $condicion_pago);

$aCondicion_Pagos = $condicion_pago->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aCondicion_Pagos);

$smarty->assign("titulo", "Listado del Condicion_Pago");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
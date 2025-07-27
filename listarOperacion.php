<?php
include_once ("Clases/Operacion.php");
$operacion = new Operacion();

$OBJETO='Operacion';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','AUFNR','ROUTING_NO','COUNTER','SEQUENCE_NO',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $operacion);

$aOperacions = $operacion->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aOperacions);

$smarty->assign("titulo", "Listado del Operacion");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
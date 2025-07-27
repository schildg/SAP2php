<?php
include_once ("Clases/Clase_Movimiento.php");
$clase_movimiento = new Clase_Movimiento();

$OBJETO='Clase_Movimiento';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','clase_movimiento','nombre','signo_para_anita',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $clase_movimiento);

$aClase_Movimientos = $clase_movimiento->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aClase_Movimientos);

$smarty->assign("titulo", "Listado del Clase_Movimiento");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
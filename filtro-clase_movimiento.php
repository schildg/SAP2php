<?php
include_once ("Clases/Clase_Movimiento.php");
$smarty = new ExtendOfSmarty();
$clase_movimiento = new Clase_Movimiento();
$OBJETO = 'Clase_Movimiento';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','clase_movimiento','nombre','signo_para_anita',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del clase_movimiento");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aClase_Movimientos = $clase_movimiento->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aClase_Movimientos);

$smarty->display('ListadorDeDatos.tpl');
?>
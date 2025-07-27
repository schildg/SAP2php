<?php
include_once ("Clases/Establecimiento.php");
$smarty = new Smarty();
$establecimiento = new Establecimiento();
$OBJETO = 'Establecimiento';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','nombre','direccion','tipo','nivel','localidad_id','logo_1','logo_2');

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del establecimiento");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aEstablecimientos = $establecimiento->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aEstablecimientos);

$smarty->display('ListadorDeDatos.tpl');
?>
<?php
include_once ("Clases/Tabla.php");
$smarty = new Smarty();
$tabla = new Tabla();
$OBJETO = 'Tabla';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','campo','numero','habilitado','nombre','noco','objeto');

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los valores de las Tablas");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');


include_once ("datos-filtro-listador.php");

$aTablas = $tabla->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aTablas);

$smarty->display('ListadorDeDatos.tpl');
?>
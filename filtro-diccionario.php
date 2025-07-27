<?php
include_once ("Clases/Diccionario.php");
$smarty = new Smarty();
$diccionario = new Diccionario();
$OBJETO = 'Diccionario';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','objeto','campo','gene_historia','leye_historia','objeto_foraneo','campo_foraneo','es_unico','es_foraneo','leyenda','ayuda','descripcion');

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del diccionario");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aDiccionarios = $diccionario->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aDiccionarios);

$smarty->display('ListadorDeDatos.tpl');
?>
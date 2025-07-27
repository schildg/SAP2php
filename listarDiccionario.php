<?php
include_once ("Clases/Diccionario.php");
$diccionario = new Diccionario();

$OBJETO='Diccionario';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','objeto','campo','gene_historia','leye_historia','objeto_foraneo','campo_foraneo','es_unico','es_foraneo','leyenda','ayuda','descripcion');

include_once ("datos-listador.php");

$smarty->assign("objeto", $diccionario);

$aDiccionarios = $diccionario->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aDiccionarios);

$smarty->assign("titulo", "Listado del Diccionario");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
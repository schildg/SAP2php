<?php
include_once ("Clases/Ns_Rel.php");
$ns_rel = new Ns_Rel();

$OBJETO='Ns_Rel';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','tipo_ns','cdoc_ns','ndoc_ns','item_ns',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $ns_rel);

$aNs_Rels = $ns_rel->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aNs_Rels);

$smarty->assign("titulo", "Listado del Ns_Rel");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
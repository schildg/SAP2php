<?php
include_once ("Clases/Sf_Arc.php");
$sf_arc = new Sf_Arc();

$OBJETO='Sf_Arc';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','nreg_sf','letr_sf','nume_sf','nfa1_sf',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $sf_arc);

$aSf_Arcs = $sf_arc->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aSf_Arcs);

$smarty->assign("titulo", "Listado del Sf_Arc");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
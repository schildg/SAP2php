<?php
include_once ("Clases/Sf_Arc.php");
$smarty = new Smarty();
$sf_arc = new Sf_Arc();
$OBJETO = 'Sf_Arc';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','nreg_sf','letr_sf','nume_sf','nfa1_sf','nfa2_sf','nfa3_sf','nfa4_sf','nlar_sf','desc_sf','obse_sf','hist_sf','nove_sf','tipo_sf','habi_sf','cmo1_sf','cmo2_sf','cmo3_sf','nmo1_sf','nmo2_sf','nmo3_sf','nmo4_sf','des1_sf','des2_sf','des3_sf','des4_sf','list_sf','cabe_sf','gene_sf','cnts_sf','nodw_sf');

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del sf_arc");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aSf_Arcs = $sf_arc->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aSf_Arcs);

$smarty->display('ListadorDeDatos.tpl');
?>
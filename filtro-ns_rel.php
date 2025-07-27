<?php
include_once ("Clases/Ns_Rel.php");
$smarty = new Smarty();
$ns_rel = new Ns_Rel();
$OBJETO = 'Ns_Rel';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','tipo_ns','cdoc_ns','ndoc_ns','item_ns','site_ns','cmov_ns','nmov_ns','tip1_ns','prod_ns','marc_ns','enva_ns','cenv_ns','cmo1_ns','nmo1_ns','tip2_ns','csap_ns','nsap_ns','cmo2_ns','nmo2_ns');

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del ns_rel");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aNs_Rels = $ns_rel->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aNs_Rels);

$smarty->display('ListadorDeDatos.tpl');
?>
<?php
include_once ("Clases/St_Lar.php");
$smarty = new Smarty();
$st_lar = new St_Lar();
$OBJETO = 'St_Lar';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','prod_gd','marc_gd','enva_gd','cenv_gd','cmov_gd','nmov_gd','item_gd','site_gd','cant_gd','prec_gd','sape_gd','sapf_gd','cost_gd','refe_gd','tenv_gd','forn_gd','nfor_gd','moti_gd','itom_gd','cdo1_gd','ndo1_gd','cdo2_gd','ndo2_gd','ndo3_gd','exca_gd','cete_gd','nete_gd','tipo_gd','val1_gd','val2_gd','val3_gd','val4_gd','val5_gd','cprr_gd','nprr_gd','marr_gd','envr_gd','cenr_gd','fill_gd',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del st_lar");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aSt_Lars = $st_lar->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aSt_Lars);

$smarty->display('ListadorDeDatos.tpl');
?>
<?php
include_once ("Clases/St_Doc.php");
$smarty = new Smarty();
$st_doc = new St_Doc();
$OBJETO = 'St_Doc';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','esta_sd','clie_sd','fech_sd','cmov_sd','nmov_sd','fec1_sd','cmo1_sd','nmo1_sd','lfac_sd','lcer_sd','moti_sd','itom_sd','itom_sdt','tran_sd','rede_sd','cdoc_sd','ndoc_sd','cont_sd','copa_sd','cop1_sd','cop2_sd','cop3_sd','desc_sd','ides_sd','fil1_sd','tave_sd','tave_sdt','auve_sd','tacr_sd','tacr_sdt','aucr_sd','viaj_sd','copi_sd','hrut_sd','habi_sd','pota_sd','pota_sdt','coca_sd','aten_sd','cdo1_sd','ndo1_sd','orde_sd','innu_sd','toke_sd','per1_sd','per2_sd','ndo2_sd','tipo_sd','ordc_sd','zona_sd','zona_sdt','dire_sd','momi_sd','momi_sdt','de01_sd','de02_sd','firm_sd','firm_sdt','dola_sd','tvta_sd','tvta_sdt','clas_sd','tneg_sd','tneg_sdt','mone_sd','mone_sdt','lota_sd','como_sd','ifle_sd','fill_sd','lore_sd','prod_sd001','prod_sd002','prod_sd003','prod_sd004','prod_sd005','prod_sd006','prod_sd007','prod_sd008','prod_sd009','prod_sd010','marc_sd001','marc_sd002','marc_sd003','marc_sd004','marc_sd005','marc_sd006','marc_sd007','marc_sd008','marc_sd009','marc_sd010','enva_sd001','enva_sd002','enva_sd003','enva_sd004','enva_sd005','enva_sd006','enva_sd007','enva_sd008','enva_sd009','enva_sd010','cenv_sd001','cenv_sd002','cenv_sd003','cenv_sd004','cenv_sd005','cenv_sd006','cenv_sd007','cenv_sd008','cenv_sd009','cenv_sd010','cant_sd001','cant_sd002','cant_sd003','cant_sd004','cant_sd005','cant_sd006','cant_sd007','cant_sd008','cant_sd009','cant_sd010','prec_sd001','prec_sd002','prec_sd003','prec_sd004','prec_sd005','prec_sd006','prec_sd007','prec_sd008','prec_sd009','prec_sd010','sapf_sd001','sapf_sd002','sapf_sd003','sapf_sd004','sapf_sd005','sapf_sd006','sapf_sd007','sapf_sd008','sapf_sd009','sapf_sd010','sape_sd001','sape_sd002','sape_sd003','sape_sd004','sape_sd005','sape_sd006','sape_sd007','sape_sd008','sape_sd009','sape_sd010','refe_sd001','refe_sd002','refe_sd003','refe_sd004','refe_sd005','refe_sd006','refe_sd007','refe_sd008','refe_sd009','refe_sd010','cost_sd001','cost_sd002','cost_sd003','cost_sd004','cost_sd005','cost_sd006','cost_sd007','cost_sd008','cost_sd009','cost_sd010','tenv_sd001','tenv_sd002','tenv_sd003','tenv_sd004','tenv_sd005','tenv_sd006','tenv_sd007','tenv_sd008','tenv_sd009','tenv_sd010','forn_sd001','forn_sd002','forn_sd003','forn_sd004','forn_sd005','forn_sd006','forn_sd007','forn_sd008','forn_sd009','forn_sd010','fil2_sd001','fil2_sd002','fil2_sd003','fil2_sd004','fil2_sd005','fil2_sd006','fil2_sd007','fil2_sd008','fil2_sd009','fil2_sd010','nfor_sd001','nfor_sd002','nfor_sd003','nfor_sd004','nfor_sd005','nfor_sd006','nfor_sd007','nfor_sd008','nfor_sd009','nfor_sd010','fil3_sd001','fil3_sd002','fil3_sd003','fil3_sd004','fil3_sd005','fil3_sd006','fil3_sd007','fil3_sd008','fil3_sd009','fil3_sd010','fil4_sd001','fil4_sd002','fil4_sd003','fil4_sd004','fil4_sd005','fil4_sd006','fil4_sd007','fil4_sd008','fil4_sd009','fil4_sd010',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del st_doc");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aSt_Docs = $st_doc->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aSt_Docs);

$smarty->display('ListadorDeDatos.tpl');
?>
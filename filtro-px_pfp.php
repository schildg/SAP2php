<?php
include_once ("Clases/Px_Pfp.php");
$smarty = new Smarty();
$px_pfp = new Px_Pfp();
$OBJETO = 'Px_Pfp';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','pend_lq','ftur_lq','htur_lq','orde_lq','esta_lq','esta_lqt','cmov_lq','nmov_lq','tipo_lq','tipo_lqt','erro_lq','erro_lqt','errn_lq','opem_lq','opem_lqt','pemb_lq','tlod_lq','tlod_lqt','fech_lq','form_lq','lotc_lq','lotc_lqt','lotn_lq','cdis_lq','cdis_lqt','ndis_lq','cdid_lq','cdid_lqt','ndid_lq','cdoc_lq','ndoc_lq','proe_lq','mare_lq','enve_lq','cene_lq','cane_lq','cemb_lq','cant_lq','cori_lq','prod_lq','marc_lq','enva_lq','cenv_lq','cfor_lq','nfor_lq','fetu_lq','hetu_lq','fefi_lq','hefi_lq','nuca_lq','cdo1_lq','ndo1_lq','hold_lq','hold_lqt','toke_lq','sect_lq','sect_lqt','caru_lq','crem_lq','caco_lq','repl_lq','taru_lq','taru_lqt','line_lq','line_lqt','depo_lq','aufa_lq','fill_lq',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del px_pfp");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aPx_Pfps = $px_pfp->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aPx_Pfps);

$smarty->display('ListadorDeDatos.tpl');
?>
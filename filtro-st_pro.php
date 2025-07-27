<?php
include_once ("Clases/St_Pro.php");
$smarty = new Smarty();
$st_pro = new St_Pro();
$OBJETO = 'St_Pro';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','desc_sp','prod_sp','desv_sp','unid_sp','desp_sp','inde_sp','grup_sp','gruv_sp','gruf_sp','gvia_sp','nreg_sp','cosf_sp','cosv_sp','cceu_sp','etiq_sp','proh_sp','fabr_sp','inco_sp','tiva_sp','habi_sp','civa_sp','stoc_sp','tcte_sp','cnta_sp','cfor_sp','insa_sp','sedr_sp','toke_sp','deci_sp','seve_sp','uceu_sp','esta_sp','tipo_sp','frac_sp','dico_sp','ries_sp','baan_sp','cert_sp','firm_sp','sean_sp','arge_sp','impo_sp','tinv_sp','hadm_sp','htec_sp','nhse_sp','sena_sp','soli_sp','sese_sp','pweb_sp','mven_sp','lprx_sp','dens_sp','ttiv_sp','inam_sp','cliv_sp','leye_sp','esol_sp','mezc_sp','exci_sp','ufab_sp','prop_sp','drep_sp','oper_sp','paip_sp','tran_sp','tili_sp','cofi_sp','domi_sp','rpro_sp','rtim_sp','sene_sp','inal_sp','cckg_sp','ccim_sp','inro_sp','lvin_sp','ncas_sp','inmp_sp','cdep_sp','ndep_sp','pors_sp','cate_sp','labo_sp','ectl_sp',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del st_pro");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aSt_Pros = $st_pro->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aSt_Pros);

$smarty->display('ListadorDeDatos.tpl');
?>
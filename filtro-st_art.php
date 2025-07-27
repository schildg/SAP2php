<?php
include_once ("Clases/St_Art.php");
$smarty = new Smarty();
$st_art = new St_Art();
$OBJETO = 'St_Art';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','prod_sa','marc_sa','enva_sa','cenv_sa','cenr_sa','cceu_sa','pmin_sa','spro_sa','smar_sa','senv_sa','scen_sa','soco_sa','cant_sa','habi_sa','prio_sa','arge_sa','enca_sa','ccap_sa','pall_sa','paan_sa','pala_sa','caan_sa','cala_sa','caal_sa','insp_sa','insm_sa','inse_sa','insc_sa','uceu_sa','impo_sa','desv_sa','sena_sa','soli_sa','pimi_sa','repo_sa','tusp_sa','iinv_sa','ppro_sa','pmar_sa','penv_sa','pcen_sa','dens_sa','enan_sa','enla_sa','enal_sa','peen_sa','drep_sa','paip_sa','tran_sa','etiq_sa','ckos_sa');

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del st_art");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aSt_Arts = $st_art->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aSt_Arts);

$smarty->display('ListadorDeDatos.tpl');
?>
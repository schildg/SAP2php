<?php
include_once ("Clases/St_Env.php");
$smarty = new Smarty();
$st_env = new St_Env();
$OBJETO = 'St_Env';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','desc_se','enva_se','deco_se','habi_se','ncen_se','fill_se',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del st_env");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aSt_Envs = $st_env->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aSt_Envs);

$smarty->display('ListadorDeDatos.tpl');
?>
<?php
include_once ("Clases/St_Env.php");
$st_env = new St_Env();

$OBJETO='St_Env';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','desc_se','enva_se','deco_se','habi_se',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $st_env);

$aSt_Envs = $st_env->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aSt_Envs);

$smarty->assign("titulo", "Listado del St_Env");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
<?php
include_once ("Clases/Sf_Dic.php");
$smarty = new Smarty();
$sf_dic = new Sf_Dic();
$OBJETO = 'Sf_Dic';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','letr_di','line_di','nomb_di','nive_di','sign_di','tipo_di','long_di','deci_di','clas_di','comp_di','occu_di','indi_di','desc_di','cond_di','crel_di','then_di','else_di','acce_di','vocc_di','nove_di','list_di','geta_di','deau_di','repe_di','dwho_di','nuno_di','cfun_di','nfun_di','saln_di','salx_di');

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del Diccionario Anita");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aSf_Dics = $sf_dic->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aSf_Dics);

$smarty->display('ListadorDeDatos.tpl');
?>
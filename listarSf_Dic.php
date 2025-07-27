<?php
include_once ("Clases/Sf_Dic.php");
$sf_dic = new Sf_Dic();

$OBJETO='Sf_Dic';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','letr_di','line_di','nomb_di','nive_di',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $sf_dic);

$aSf_Dics = $sf_dic->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aSf_Dics);

$smarty->assign("titulo", "Listado del Diccionario Anita");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
<?php
include_once ("Clases/St_Pro.php");
$st_pro = new St_Pro();

$OBJETO='St_Pro';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','desc_sp','prod_sp','desv_sp','unid_sp',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $st_pro);

$aSt_Pros = $st_pro->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aSt_Pros);

$smarty->assign("titulo", "Listado del St_Pro");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
<?php
include_once ("Clases/Attach.php");
$attach = new Attach();

$OBJETO='Attach';
$SUBOBJETO=$OBJETO;
$CAMPOS=array('nombre','mime','tmp_name');

include_once ("datos-listador.php");

$smarty->assign("objeto", $attach);

if(strstr($accion,'VerAttach')){
	$obje_id=$_GET['objeto_id'];
	$obje=substr($accion,9);
	$sql="objeto ='$obje' and objeto_id ='$obje_id' ";
}else{
	$sql='';
}

$aAttachs = $attach->FindAll($OBJETO,$sql,$ORDEN);

$smarty->assign("listaObjetos", $aAttachs);
$smarty->assign("obje", $obje);
$smarty->assign("obje_id", $obje_id);

$smarty->display('listarAttachados.tpl');
?>
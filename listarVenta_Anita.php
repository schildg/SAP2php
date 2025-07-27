<?php
include_once ("Clases/Venta_Anita.php");
$venta_anita = new Venta_Anita();

$OBJETO='Venta_Anita';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','CRM_ID','KUNNR','MATNR','KUNN2',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $venta_anita);

$aVenta_Anitas = $venta_anita->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aVenta_Anitas);

$smarty->assign("titulo", "Listado del Venta_Anita");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
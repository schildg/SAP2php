<?php
include_once ("Clases/Resultado_ORD_FAB_Consumo.php");
$resultado_ord_fab_consumo = new Resultado_ORD_FAB_Consumo();

$OBJETO='Resultado_ORD_FAB_Consumo';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','TYPE','ID_SAP','NUMBER','MESSAGE',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $resultado_ord_fab_consumo);

$aResultado_ORD_FAB_Consumos = $resultado_ord_fab_consumo->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aResultado_ORD_FAB_Consumos);

$smarty->assign("titulo", "Listado del Resultado_ORD_FAB_Consumo");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
<?php
include_once ("Clases/Resultado_Ejecucion.php");
$resultado_ejecucion = new Resultado_Ejecucion();

$OBJETO='Resultado_Ejecucion';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','RFC','id_objeto_sap','TYPE','ID_SAP',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $resultado_ejecucion);

$aResultado_Ejecucions = $resultado_ejecucion->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aResultado_Ejecucions);

$smarty->assign("titulo", "Listado del Resultado_Ejecucion");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
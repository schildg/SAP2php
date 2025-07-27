<?php
include_once ("Clases/Resultado_Ejecucion.php");
$smarty = new Smarty();
$resultado_ejecucion = new Resultado_Ejecucion();
$OBJETO = 'Resultado_Ejecucion';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','RFC','id_objeto_sap','TYPE','ID_SAP','NUMBER','MESSAGE','LOG_NO','LOG_MSG_NO','MESSAGE_V1','MESSAGE_V2','MESSAGE_V3','MESSAGE_V4','PARAMETER','FIELD','SYSTEM',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del resultado_ejecucion");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aResultado_Ejecucions = $resultado_ejecucion->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aResultado_Ejecucions);

$smarty->display('ListadorDeDatos.tpl');
?>
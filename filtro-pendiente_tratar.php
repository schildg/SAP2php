<?php
include_once ("Clases/Pendiente_Tratar.php");
$smarty = new Smarty();
$pendiente_tratar = new Pendiente_Tratar();
$OBJETO = 'Pendiente_Tratar';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','objeto','id_objeto','estado','codigo','numero','numero_sap');

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del pendiente_tratar");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aPendiente_Tratars = $pendiente_tratar->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aPendiente_Tratars);

$smarty->display('ListadorDeDatos.tpl');
?>
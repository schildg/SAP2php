<?php
include_once ("Clases/Existencia_Material.php");
$smarty = new Smarty();
$existencia_material = new Existencia_Material();
$OBJETO = 'Existencia_Material';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MATNR','WERKS','LGORT','PSTAT','LVORM','LFGJA','LFMON','SPERR','LABST','UMLME','INSME','EINME','SPEME','RETME','VMLAB','VMUML','VMINS','VMEIN','VMSPE','VMRET','KZILL','KZILQ','KZILE','KZILS','KZVLL','KZVLQ','KZVLE','KZVLS','DISKZ','LSOBS','LMINB','LBSTF','HERKL','EXPPG','EXVER','LGPBE','KLABS','KINSM','KEINM','KSPEM','DLINL','PRCTL','ERSDA','VKLAB','VKUML','LWMKB','MDRUE','MDJIN',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del existencia_material");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aExistencia_Materials = $existencia_material->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aExistencia_Materials);

$smarty->display('ListadorDeDatos.tpl');
?>
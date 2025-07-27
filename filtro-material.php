<?php
include_once ("Clases/Material.php");
$smarty = new Smarty();
$material = new Material();
$OBJETO = 'Material';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MATNR','ERSDA','ERNAM','LAEDA','AENAM','MTART','MBRSH','MATKL','BISMT','MEINS','FERTH','FORMT','GROES','WRKST','NORMT','LABOR','BRGEW','NTGEW','GEWEI','VOLUM','VOLEH','BEHVO','RAUBE','TEMPB','SPART','EAN11','NUMTP','LAENG','BREIT','HOEHE','MEABM','ATTYP','MFRPN','MFRNR',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del material");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aMaterials = $material->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aMaterials);

$smarty->display('ListadorDeDatos.tpl');
?>
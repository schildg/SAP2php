<?php
include_once ("Clases/Out_OrdFab_Consumo.php");
$smarty = new Smarty();
$out_ordfab_consumo = new Out_OrdFab_Consumo();
$OBJETO = 'Out_OrdFab_Consumo';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','AUFNR','RSPOS','MATNR','WERKS','CHARG','LGORT','SOBKZ','VORNR','MENGE','MEINS','ERFMG','ERFME','VHILM','EXBNR','EXIDV','EXIDV_OB','EXPLZ','ERNAM','ERDAT','ERZET','TWFLG','BERTS',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del out_ordfab_consumo");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aOut_OrdFab_Consumos = $out_ordfab_consumo->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aOut_OrdFab_Consumos);

$smarty->display('ListadorDeDatos.tpl');
?>
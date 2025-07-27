<?php
include_once ("Clases/Almacen.php");
$smarty = new Smarty();
$almacen = new Almacen();
$OBJETO = 'Almacen';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','WERKS','LGORT','LGOBE','SPART','XLONG','XBUFX','DISKZ','XBLGO','XRESS','XHUPF','PARLG','VKORG','VTWEG','VSTEL','LIFNR','KUNNR','MESBS','MESST','OIH_LICNO','OIG_ITRFL','OIB_TNKASSIGN',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del almacen");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aAlmacens = $almacen->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aAlmacens);

$smarty->display('ListadorDeDatos.tpl');
?>
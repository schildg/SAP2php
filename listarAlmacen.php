<?
include_once ("Clases/Almacen.php");
$almacen = new Almacen();

$OBJETO='Almacen';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','WERKS','LGORT','LGOBE','SPART',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $almacen);

$aAlmacens = $almacen->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aAlmacens);

$smarty->assign("titulo", "Listado del Almacen");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
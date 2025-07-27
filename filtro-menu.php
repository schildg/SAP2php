<?php
include_once ("Clases/Menu.php");
$smarty = new Smarty();
$menu = new Menu();
$OBJETO = 'Menu';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','tipo_menu','denominacion','habilitado');

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de menues");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aMenus = $menu->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aMenus);

$smarty->display('ListadorDeDatos.tpl');
?>
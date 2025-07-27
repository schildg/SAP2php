<?php
include_once ("Clases/Menu_Menu.php");
$smarty = new Smarty();
$menu_menu = new Menu_Menu();
$OBJETO = 'Menu_Menu';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','menu_id','menu_id1','habilitado');

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de las relaciones de submenues en un menu");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aMenu_Menus = $menu_menu->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aMenu_Menus);

$smarty->display('ListadorDeDatos.tpl');
?>
<?php
include_once ("Clases/Menu_Menu.php");
$menu_menu = new Menu_Menu();

$OBJETO='Menu_Menu';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','menu_id','menu_id1','habilitado');

include_once ("datos-listador.php");

$smarty->assign("objeto", $menu_menu);

$aMenu_Menus = $menu_menu->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aMenu_Menus);

$smarty->assign("titulo", "Listado de las Submenues en un Menu");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
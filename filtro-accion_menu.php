<?php
include_once ("Clases/Accion_Menu.php");
$accion_menu = new Accion_Menu();
$smarty = new Smarty();
$OBJETO='Accion_Menu';
$SUBOBJETO=$OBJETO;
$CAMPOS=array('id','menu_id','accion_id','habilitado');

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de las Acciones en un Menu");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aAccion_Menus = $accion_menu->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aAccion_Menus);

$smarty->display('ListadorDeDatos.tpl');
?>
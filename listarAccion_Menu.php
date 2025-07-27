<?php
include_once ("Clases/Accion_Menu.php");
$accion_menu = new Accion_Menu();
$OBJETO='Accion_Menu';
$SUBOBJETO=$OBJETO;
$CAMPOS=array('id','menu_id','accion_id','habilitado');

include_once ("datos-listador.php");

$smarty->assign("objeto", $accion_menu);

$aAccion_Menus = $accion_menu->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aAccion_Menus);

$smarty->assign("titulo", "Listado de las Acciones en un Menu");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
<?php
include_once ("Clases/Menu.php");
$menu = new Menu();

$OBJETO='Menu';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','tipo_menu','denominacion','habilitado');

include_once ("datos-listador.php");

$smarty->assign("objeto", $menu);

$aMenus = $menu->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aMenus);

$smarty->assign("titulo", "Listado de los Menues");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
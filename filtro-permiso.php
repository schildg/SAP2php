<?php
include_once ("Clases/Permiso.php");
$smarty = new Smarty();
$permiso = new Permiso();
$OBJETO = 'Permiso';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','usuario_id','accion_id','habilitado');

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los permisos");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aPermisos = $permiso->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aPermisos);

$smarty->display('ListadorDeDatos.tpl');
?>
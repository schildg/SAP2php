<?php
include_once ("Clases/Permiso.php");
$permiso = new Permiso();

$OBJETO='Permiso';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','usuario_id','accion_id','habilitado');

include_once ("datos-listador.php");

$smarty->assign("objeto", $permiso);

$aPermisos = $permiso->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aPermisos);

$smarty->assign("titulo", "Listado de los Permisos");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
<?php
include_once ("Clases/Usuario_Establecimiento.php");
$usuario_establecimiento = new Usuario_Establecimiento();

$OBJETO='Usuario_Establecimiento';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','usuario_id','establecimiento_id');

include_once ("datos-listador.php");

$smarty->assign("objeto", $usuario_establecimiento);

$aUsuario_Establecimientos = $usuario_establecimiento->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aUsuario_Establecimientos);

$smarty->assign("titulo", "Listado del Usuario_Establecimiento");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
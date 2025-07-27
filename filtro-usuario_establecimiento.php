<?php
include_once ("Clases/Usuario_Establecimiento.php");
$smarty = new Smarty();
$usuario_establecimiento = new Usuario_Establecimiento();
$OBJETO = 'Usuario_Establecimiento';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','usuario_id','establecimiento_id');

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del usuario_establecimiento");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aUsuario_Establecimientos = $usuario_establecimiento->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aUsuario_Establecimientos);

$smarty->display('ListadorDeDatos.tpl');
?>
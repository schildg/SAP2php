<?php
include_once ("Clases/Usuario.php");
$usuario = new Usuario();

$OBJETO='Usuario';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','Nombre','Apellido','login','email','habilitado','menu_id');

include_once ("datos-listador.php");

$smarty->assign("objeto", $usuario);


$aUsuarios = $usuario->FindAll($OBJETO,'',$ORDEN);
$smarty->assign("listaObjetos", $aUsuarios);

$smarty->assign("titulo", "Listado de los Usuarios");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');

?>
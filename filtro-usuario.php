<?php
include_once ("Clases/Usuario.php");
$smarty = new Smarty();
$usuario = new Usuario();
$OBJETO = 'Usuario';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','Nombre','Apellido','login','email','habilitado','menu_id');

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los Usuarios");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');


include_once ("datos-filtro-listador.php");

$aUsuarios = $usuario->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aUsuarios);

$smarty->display('ListadorDeDatos.tpl');
?>
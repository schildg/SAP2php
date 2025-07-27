<?php
include_once ("Clases/Servicio.php");
$smarty = new Smarty();
$servicio = new Servicio();
$OBJETO = 'Servicio';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','nombre_servicio','estado','subestado','secuencia','paquete','mensaje','pid',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del servicio");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aServicios = $servicio->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aServicios);

$smarty->display('ListadorDeDatos.tpl');
?>
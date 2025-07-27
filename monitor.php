<?php
$smarty  = new Smarty();
include_once ("Clases/Servicio.php");

if (isset ($_POST['services'])) {
	$services = $_POST['services'];
} else {
	$services = $_GET['services'];
}
if (isset ($_POST['ServiceAction'])) {
	$ServiceAction = $_POST['ServiceAction'];
} else {
	$ServiceAction = $_GET['ServiceAction'];
}

$serv = New Servicio($services);

switch ($ServiceAction) {
	case "start()"      : $serv->start();
		break;
	case "stop()"       : $serv->stop();
		break;
	case "trato_secue()": $serv->trato_secue();
		break;
	case "trato_error()": $serv->trato_error();
		break;
}


$servicios = New Servicio();
$servicios=$servicios->FindAll('Servicio');

$smarty->assign("self", $self);
$smarty->assign("servicios", $servicios);
$smarty->assign("OBJETO", $serv->CLASE_OBJETO);
$smarty->assign("SUBOBJETO", $serv->CLASE_OBJETO);

$smarty->display('monitor.tpl');
?>




<?php
include_once ("Clases/Servicio.php");

if ( isset($_GET['ServiceAction']) and strlen($_GET['ServiceAction']) ) {
    $ServiceAction = addslashes($_GET['ServiceAction']);
} else if ( isset($argv) and isset($argv[1]) and strlen($argv[1]) ) {
    $ServiceAction = $argv[1];
}

$serv = New Servicio("comprimeAnita");

switch ($ServiceAction) {
	case "start"      : $serv->start();
		break;
	case "stop"       : $serv->stop();
		break;
}


?>
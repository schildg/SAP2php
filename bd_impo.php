<?php
include_once ("Clases/Servicio.php");

if ( isset($_GET['ServiceAction']) and strlen($_GET['ServiceAction']) and isset($_GET['NameServices']) and strlen($_GET['NameServices']) ) {
    $ServiceAction = addslashes($_GET['ServiceAction']);
    $NameServices = addslashes($_GET['NameServices']);
} else if ( isset($argv) and isset($argv[1]) and strlen($argv[1]) and isset($argv[2]) and strlen($argv[2]) ) {
    $ServiceAction = $argv[2];
    $NameServices = $argv[1];
}

$serv = New Servicio($NameServices);
//sleep(3); // Pongo un delay porque se bloquean los procesos
		
switch ($ServiceAction) {
	case "start"      : $serv->start();
		break;
	case "stop"       : $serv->stop();
		break;
	case "trato_secue": $serv->trato_secue();
		break;
	case "trato_error": $serv->trato_error();
		break;
}

?>
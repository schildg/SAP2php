<?php
	$objeto=MyActiveRecord::Create($OBJETO);
	if (isset ($_POST['id'])) {
		$ID = $_POST['id'];
	} else {
		$ID = $_GET['id'];
	}
	
	$objeto = $objeto->buscar($ID);

	$amb->cargarObjeto($objeto);
	$amb->generarAMB($SUBOBJETO);
?>

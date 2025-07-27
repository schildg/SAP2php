<?php
	$objeto=MyActiveRecord::Create($OBJETO);
	$id = $_POST['id'];
	$objeto = $objeto->buscar($id);
	$objeto->destroy();
	if( $objeto->get_errors() ){
	    $amb->cargarObjeto($objeto);
		$amb->generarAMB($SUBOBJETO);
	}else
	{
		$amb->ok_del();
	};	
?>

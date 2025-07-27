<?php
	$objeto->save();
	if( $objeto->get_errors() ){
	    $amb->cargarObjeto($objeto);
		$amb->generarAMB($SUBOBJETO);
	}else
	{
		$amb->ok();
	};
?>

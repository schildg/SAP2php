<?php
include_once ("Clases/St_Rld.php");
include_once ("Clases/AMB.php");
$st_rld = new St_Rld();
$OBJETO = 'St_Rld';
$SUBOBJETO=$OBJETO;
$amb = new AMB('St_Rld');
$CAMPOS = array('id','cmov_sr','nmov_sr','item_sr','pro1_sr','lotc_sr','lotn_sr','prod_sr','marc_sr','enva_sr','cenv_sr','sign_sr','cant_sr','depo_sr','dep1_sr','moti_sr','itom_sr','fill_sr',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el St_Rld');
$amb->cargarTituloObjeto('un St_Rld');
switch ($accion) {
	case "editar$SUBOBJETO" :
		include_once ("editarObjeto.php");
		break;
	case "borrar$SUBOBJETO" :
		include_once ("borrarObjeto.php");
		break;
	case "alta$SUBOBJETO" :
		include_once ("altaObjeto.php");
		break;
	case $SUBOBJETO :
		include_once ("accionObjeto.php");
		include_once ("accionObjetoGuardar.php");
		break;
};

?>
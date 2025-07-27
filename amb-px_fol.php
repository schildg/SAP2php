<?php
include_once ("Clases/Px_Fol.php");
include_once ("Clases/AMB.php");
$px_fol = new Px_Fol();
$OBJETO = 'Px_Fol';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Px_Fol');
$CAMPOS = array('id','prod_ll','cmov_ll','nmov_ll','item_ll','site_ll','cant_ll','orde_ll','agma_ll','micr_ll','epex_ll','epec_ll','fill_ll',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Px_Fol');
$amb->cargarTituloObjeto('un Px_Fol');
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
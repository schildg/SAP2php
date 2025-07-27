<?php
include_once ("Clases/St_Env.php");
include_once ("Clases/AMB.php");
$st_env = new St_Env();
$OBJETO = 'St_Env';
$SUBOBJETO=$OBJETO;
$amb = new AMB('St_Env');
$CAMPOS = array('id','desc_se','enva_se','deco_se','habi_se','ncen_se','fill_se',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el St_Env');
$amb->cargarTituloObjeto('un St_Env');
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
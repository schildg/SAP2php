<?php
include_once ("Clases/At_Mov.php");
include_once ("Clases/AMB.php");
$at_mov = new At_Mov();
$OBJETO = 'At_Mov';
$SUBOBJETO=$OBJETO;
$amb = new AMB('At_Mov');
$CAMPOS = array('id','cmov_lu','nmov_lu','AUFNR','EXIDV_OB','estado','MBLNR','MJAH',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el At_Mov');
$amb->cargarTituloObjeto('un At_Mov');
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
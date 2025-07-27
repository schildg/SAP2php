<?php
include_once ("Clases/Ut_Hu.php");
include_once ("Clases/AMB.php");
$ut_hu = new Ut_Hu();
$OBJETO = 'Ut_Hu';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Ut_Hu');
$CAMPOS = array('id','cmov_lu','nmov_lu','AUFNR','EXIDV_OB','estado',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Ut_Hu');
$amb->cargarTituloObjeto('un Ut_Hu');
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
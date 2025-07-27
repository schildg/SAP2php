<?php
include_once ("Clases/Pendiente_Tratar.php");
include_once ("Clases/AMB.php");
$pendiente_tratar = new Pendiente_Tratar();
$OBJETO = 'Pendiente_Tratar';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Pendiente_Tratar');
$CAMPOS = array('id','objeto','id_objeto','estado','codigo','numero',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Pendiente_Tratar');
$amb->cargarTituloObjeto('un Pendiente_Tratar');
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
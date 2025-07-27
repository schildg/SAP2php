<?php
include_once ("Clases/Usuario_Establecimiento.php");
include_once ("Clases/AMB.php");
$usuario_establecimiento = new Usuario_Establecimiento();
$OBJETO = 'Usuario_Establecimiento';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Usuario_Establecimiento');
$CAMPOS = array('id','usuario_id','establecimiento_id');
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de Usuarios en un Establecimiento');
$amb->cargarTituloObjeto('un Usuario en un Establecimiento');
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
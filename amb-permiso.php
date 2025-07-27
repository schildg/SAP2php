<?php
include_once ("Clases/Permiso.php");
include_once ("Clases/AMB.php");
$permiso = new Permiso();
$OBJETO = 'Permiso';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Permiso');
$CAMPOS = array('id','usuario_id','accion_id','habilitado');
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de un Permiso de una persona');
$amb->cargarTituloObjeto('un Permiso de una Persona');
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
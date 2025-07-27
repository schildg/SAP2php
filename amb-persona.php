<?php
include_once ("Clases/Persona.php");
include_once ("Clases/AMB.php");
$persona = new Persona();
$OBJETO = 'Persona';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Persona');
$CAMPOS = array('id','Nombre','Apellido','DNI','fecha_nac','Sexo','G_sanguineo','localidad_id','Es_Alumno','Es_Docente','Es_Tutor','telefono');
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de una Persona');
$amb->cargarTituloObjeto('una Persona');
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
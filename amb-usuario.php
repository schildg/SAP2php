<?php
include_once ("Clases/Usuario.php");
include_once ("Clases/AMB.php");
$usuario = new Usuario();
$OBJETO = 'Usuario';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Usuario');
$CAMPOS = array('id','Nombre','Apellido','login','email','habilitado','menu_id');
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de un Usuario');
$amb->cargarTituloObjeto('un Usuario');
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
		if ($objeto->id == 0){
			$objeto->guardarPsw('qwe123');		
		}
		include_once ("accionObjetoGuardar.php");
		break;
};

?>
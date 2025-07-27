<?php
include_once ("Clases/Servicio.php");
include_once ("Clases/AMB.php");
$servicio = new Servicio();
$OBJETO = 'Servicio';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Servicio');
$CAMPOS = array('id','nombre_servicio','estado','subestado','secuencia','paquete','mensaje','pid',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Servicio');
$amb->cargarTituloObjeto('un Servicio');
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
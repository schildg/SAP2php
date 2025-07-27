<?php
include_once ("Clases/Actualizacion_CRM.php");
include_once ("Clases/AMB.php");
$actualizacion_crm = new Actualizacion_CRM();
$OBJETO = 'Actualizacion_CRM';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Actualizacion_CRM');
$CAMPOS = array('id','Objeto','Ultima_Actualizacion',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Actualizacion_CRM');
$amb->cargarTituloObjeto('un Actualizacion_CRM');
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
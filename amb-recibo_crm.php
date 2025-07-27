<?php
include_once ("Clases/Recibo_CRM.php");
include_once ("Clases/AMB.php");
$recibo_crm = new Recibo_CRM();
$OBJETO = 'Recibo_CRM';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Recibo_CRM');
$CAMPOS = array('id','BUKRS','BELNR','GJAHR','BLART','CRM_ID','FKDAT','DICOB','KUNNR','DIATR','KUNN2','UNNEG','DMBTR','DMBE2','SABTR','SABE2','WAERS',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Recibo_CRM');
$amb->cargarTituloObjeto('un Recibo_CRM');
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
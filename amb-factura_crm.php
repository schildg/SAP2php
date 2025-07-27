<?php
include_once ("Clases/Factura_CRM.php");
include_once ("Clases/AMB.php");
$factura_crm = new Factura_CRM();
$OBJETO = 'Factura_CRM';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Factura_CRM');
$CAMPOS = array('id','VBELN','WAERK','VKORG','VTWEG','FKDAT','KURRF','ZTERM','CRM_ID','FKVEN','FKREC','KUNNR','DIATR','KUNN2',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Factura_CRM');
$amb->cargarTituloObjeto('un Factura_CRM');
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
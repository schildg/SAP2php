<?php
include_once ("Clases/Cliente_CRM.php");
include_once ("Clases/AMB.php");
$cliente_crm = new Cliente_CRM();
$OBJETO = 'Cliente_CRM';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Cliente_CRM');
$CAMPOS = array('id','CRM_ID','KUNNR','VKORG','VTWEG','SPART','NAME1','STCD1','STRAS','ORT02','PSTLZ','REGIO','LAND1','FITYP','ZTERM','KKBER','KLIMK','KUNN2','OWNER',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Cliente_CRM');
$amb->cargarTituloObjeto('un Cliente_CRM');
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
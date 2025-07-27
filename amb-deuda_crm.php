<?php
include_once ("Clases/Deuda_CRM.php");
include_once ("Clases/AMB.php");
$deuda_crm = new Deuda_CRM();
$OBJETO = 'Deuda_CRM';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Deuda_CRM');
$CAMPOS = array('id','FECHA','CODIGO_PAIS','BLART','VBELN','BUKRS','BELNR','GJAHR','XBLNR','WAERK','VKORG','VTWEG','FKDAT','KURRF','ZTERM','KUNNR','KUNN2','DMBTR','DMBE2','SABTR','SABE2','KKBER','ZFBDT','SHKZG',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Deuda_CRM');
$amb->cargarTituloObjeto('un Deuda_CRM');
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
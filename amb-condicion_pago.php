<?php
include_once ("Clases/Condicion_Pago.php");
include_once ("Clases/AMB.php");
$condicion_pago = new Condicion_Pago();
$OBJETO = 'Condicion_Pago';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Condicion_Pago');
$CAMPOS = array('id','ZTERM','ZTAGG','ZDART','ZFAEL','ZMONA','ZTAG1','ZPRZ1','ZTAG2','ZPRZ2','ZTAG3','ZSTG1','ZSMN1','ZSTG2','ZSMN2','ZSTG3','ZSMN3','XZBRV','ZSCHF','XCHPB','TXN08','ZLSCH','XCHPM','KOART','XSPLT','XSCRC','TEXT1');
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Condicion_Pago');
$amb->cargarTituloObjeto('un Condicion_Pago');
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
<?php
include_once ("Clases/Cheques.php");
include_once ("Clases/AMB.php");
$cheques = new Cheques();
$OBJETO = 'Cheques';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Cheques');
$CAMPOS = array('id','BUKRS','NCHCK','BLDAT','BELNR','GJAHR','BUZEI','FEEMI','FEVEN','TPCHK','INDDF','BANK','SUCU','POST','LOCA','CHCKR','WAERS','WRBTR','CTAB','CART','CLAU','EMIS','KUNNR','SEGMT','LOTE','ESTAD','SEL',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Cheques');
$amb->cargarTituloObjeto('un Cheques');
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
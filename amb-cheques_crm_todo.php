<?php
include_once ("Clases/Cheques_CRM_TODO.php");
include_once ("Clases/AMB.php");
$cheques_crm_todo = new Cheques_CRM_TODO();
$OBJETO = 'Cheques_CRM_TODO';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Cheques_CRM_TODO');
$CAMPOS = array('id','CRM_ID','BUKRS','NCHCK','BLDAT','BELNR','GJAHR','BUZEI','FEEMI','FEVEN','TPCHK','INDDF','BANK','SUCU','POST','LOCA','CHCKR','WAERS','WRBTR','CTAB','CART','CLAU','EMIS','KUNNR','PRCTR','SEGMT','LOTE','ESTAD','KKBER','SEL','DMBE2',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Cheques_CRM_TODO');
$amb->cargarTituloObjeto('un Cheques_CRM_TODO');
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
<?php
include_once ("Clases/PPendiente_CRM_TODO.php");
include_once ("Clases/AMB.php");
$ppendiente_crm_todo = new PPendiente_CRM_TODO();
$OBJETO = 'PPendiente_CRM_TODO';
$SUBOBJETO=$OBJETO;
$amb = new AMB('PPendiente_CRM_TODO');
$CAMPOS = array('id','BUKRS','CRM_ID','AUART','VBELN','POSNR','VKORG','VTWEG','AUDAT','VDATU','KUNNR','KUNN2','LAND1','MATNR','WERKS','LGORT','KWMENG','ZIEME','WAERK','STCUR','TOTAL_PESO','TOTAL_DOLAR','PRECIO_PESO','PRECIO_DOLAR','RFSTA',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el PPendiente_CRM_TODO');
$amb->cargarTituloObjeto('un PPendiente_CRM_TODO');
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
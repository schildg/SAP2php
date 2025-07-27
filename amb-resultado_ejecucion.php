<?php
include_once ("Clases/Resultado_Ejecucion.php");
include_once ("Clases/AMB.php");
$resultado_ejecucion = new Resultado_Ejecucion();
$OBJETO = 'Resultado_Ejecucion';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Resultado_Ejecucion');
$CAMPOS = array('id','RFC','id_objeto_sap','TYPE','ID_SAP','NUMBER','MESSAGE','LOG_NO','LOG_MSG_NO','MESSAGE_V1','MESSAGE_V2','MESSAGE_V3','MESSAGE_V4','PARAMETER','FIELD','SYSTEM',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Resultado_Ejecucion');
$amb->cargarTituloObjeto('un Resultado_Ejecucion');
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
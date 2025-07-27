<?php
include_once ("Clases/Stock_CRM.php");
include_once ("Clases/AMB.php");
$stock_crm = new Stock_CRM();
$OBJETO = 'Stock_CRM';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Stock_CRM');
$CAMPOS = array('id','MATNR','WERKS','LGORT','LABST','INSME','RESERV','RESERVENTRE','CURSO','CU','CU_USD','TRANSITO',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Stock_CRM');
$amb->cargarTituloObjeto('un Stock_CRM');
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
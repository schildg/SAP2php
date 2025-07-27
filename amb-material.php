<?php
include_once ("Clases/Material.php");
include_once ("Clases/AMB.php");
$material = new Material();
$OBJETO = 'Material';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Material');
$CAMPOS = array('id','MATNR','MAKTG','ERSDA','ERNAM','LAEDA','AENAM','MTART','MBRSH','MATKL','BISMT','MEINS','FERTH','FORMT','GROES','WRKST','NORMT','LABOR','BRGEW','NTGEW','GEWEI','VOLUM','VOLEH','BEHVO','RAUBE','TEMPB','SPART','EAN11','NUMTP','LAENG','BREIT','HOEHE','MEABM','ATTYP','MFRPN','MFRNR','COSTO','PRECIO_LISTADO','PRECIO_PISO',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Material');
$amb->cargarTituloObjeto('un Material');
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
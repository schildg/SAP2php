<?php
include_once ("Clases/Almacen.php");
include_once ("Clases/AMB.php");
$almacen = new Almacen();
$OBJETO = 'Almacen';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Almacen');
$CAMPOS = array('id','WERKS','LGORT','LGOBE','SPART','XLONG','XBUFX','DISKZ','XBLGO','XRESS','XHUPF','PARLG','VKORG','VTWEG','VSTEL','LIFNR','KUNNR','MESBS','MESST','OIH_LICNO','OIG_ITRFL','OIB_TNKASSIGN',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Almacen');
$amb->cargarTituloObjeto('un Almacen');
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
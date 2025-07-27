<?php
include_once ("Clases/Existencia_Material.php");
include_once ("Clases/AMB.php");
$existencia_material = new Existencia_Material();
$OBJETO = 'Existencia_Material';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Existencia_Material');
$CAMPOS = array('id','MATNR','WERKS','LGORT','PSTAT','LVORM','LFGJA','LFMON','SPERR','LABST','UMLME','INSME','EINME','SPEME','RETME','VMLAB','VMUML','VMINS','VMEIN','VMSPE','VMRET','KZILL','KZILQ','KZILE','KZILS','KZVLL','KZVLQ','KZVLE','KZVLS','DISKZ','LSOBS','LMINB','LBSTF','HERKL','EXPPG','EXVER','LGPBE','KLABS','KINSM','KEINM','KSPEM','DLINL','PRCTL','ERSDA','VKLAB','VKUML','LWMKB','MDRUE','MDJIN',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Existencia_Material');
$amb->cargarTituloObjeto('un Existencia_Material');
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
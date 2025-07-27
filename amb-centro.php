<?php
include_once ("Clases/Centro.php");
include_once ("Clases/AMB.php");
$centro = new Centro();
$OBJETO = 'Centro';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Centro');
$CAMPOS = array('id','WERKS','NAME1','BWKEY','KUNNR','LIFNR','FABKL','NAME2','STRAS','PFACH','PSTLZ','ORT01','EKORG','VKORG','CHAZV','KKOWK','KORDB','BEDPL','LAND1','REGIO','COUNC','CITYC','ADRNR','IWERK','TXJCD','VTWEG','SPART','SPRAS','WKSOP','AWSLS','CHAZV_OLD','VLFKZ','BZIRK','ZONE1','TAXIW','BZQHL','LET01','LET02','LET03','TXNAM_MA1','TXNAM_MA2','TXNAM_MA3','BETOL','J_1BBRANCH','VTBFI','FPRFW','ACHVM','DVSART','NODETYPE','NSCHEMA','PKOSA','MISCH','MGVUPD','VSTEL','MGVLAUPD','MGVLAREVAL','SOURCING','OILIVAL','OIHVTYPE','OIHCREDIPI','STORETYPE','DEP_STORE',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Centro');
$amb->cargarTituloObjeto('un Centro');
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
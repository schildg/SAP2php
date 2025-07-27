<?php
include_once ("Clases/Out_OrdFab_Consumo.php");
include_once ("Clases/AMB.php");
$out_ordfab_consumo = new Out_OrdFab_Consumo();
$OBJETO = 'Out_OrdFab_Consumo';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Out_OrdFab_Consumo');
$CAMPOS = array('id','AUFNR','RSPOS','MATNR','WERKS','CHARG','LGORT','SOBKZ','VORNR','MENGE','MEINS','ERFMG','ERFME','VHILM','EXBNR','EXIDV','EXIDV_OB','EXPLZ','ERNAM','ERDAT','ERZET','TWFLG','BERTS',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Out_OrdFab_Consumo');
$amb->cargarTituloObjeto('un Out_OrdFab_Consumo');
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
<?php
include_once ("Clases/Out_EmHu_OrdFab.php");
include_once ("Clases/AMB.php");
$out_emhu_ordfab = new Out_EmHu_OrdFab();
$OBJETO = 'Out_EmHu_OrdFab';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Out_EmHu_OrdFab');
$CAMPOS = array('id','AUFNR','tarea','MATNRHU','QUANTITY','MEINS','BUDAT','ELIKZ',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Out_EmHu_OrdFab');
$amb->cargarTituloObjeto('un Out_EmHu_OrdFab');
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
<?php
include_once ("Clases/Estruc_TrasabCob.php");
include_once ("Clases/AMB.php");
$estruc_trasabcob = new Estruc_TrasabCob();
$OBJETO = 'Estruc_TrasabCob';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Estruc_TrasabCob');
$CAMPOS = array('id','ZNREC','ZFCON','ZFDOC','ZIMPO','ZNFAC','ZNLEG','ZFACT','ZFREC','ZFDRE','ZCHCK','ZFVFA','ZVCHE','ZTMOV','ZBANK','ZMCAN',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Estruc_TrasabCob');
$amb->cargarTituloObjeto('un Estruc_TrasabCob');
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
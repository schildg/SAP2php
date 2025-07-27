<?php
include_once ("Clases/Clase_Movimiento.php");
include_once ("Clases/AMB.php");
$clase_movimiento = new Clase_Movimiento();
$OBJETO = 'Clase_Movimiento';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Clase_Movimiento');
$CAMPOS = array('id','clase_movimiento','nombre','signo_para_anita',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Clase_Movimiento');
$amb->cargarTituloObjeto('un Clase_Movimiento');
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
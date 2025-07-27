<?php
include_once ("Clases/Sl_Utr.php");
include_once ("Clases/AMB.php");
$sl_utr = new Sl_Utr();
$OBJETO = 'Sl_Utr';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Sl_Utr');
$CAMPOS = array('id','diac_lu','esta_lu','esta_lut','lotc_lu','lotn_lu','cmov_lu','nmov_lu','tipo_lu','cant_lu','sald_lu','rese_lu','cdoc_lu','ndoc_lu','frec_lu','esfi_lu','erec_lu','erec_lut','ulti_lu','isol_lu','esti_lu','esti_lut','care_lu','fill_lu',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Sl_Utr');
$amb->cargarTituloObjeto('un Sl_Utr');
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
<?php
include_once ("Clases/Sl_Tar.php");
include_once ("Clases/AMB.php");
$sl_tar = new Sl_Tar();
$OBJETO = 'Sl_Tar';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Sl_Tar');
$CAMPOS = array('id','cdoc_lt','ndoc_lt','item_lt','esta_lt','esta_ltt','fcre_lt','hcre_lt','cmov_lt','nmov_lt','dior_lt','utor_lt','cnor_lt','difi_lt','utfi_lt','cnfi_lt','cant_lt','pers_lt','ntar_lt','tipo_lt','tipo_ltt','utar_lt','prio_lt','prio_ltt','fasi_lt','hasi_lt','face_lt','hace_lt','ffin_lt','hfin_lt','auto_lt','nues_lt','nues_ltt','itom_lt','itom_ltt','erco_lt','depo_lt','diin_lt','can1_lt','per1_lt','toma_lt','toma_ltt','econ_lt','econ_ltt','equi_lt','pees_lt','cuar_lt','ipsa_lt','ppco_lt','psco_lt','fill_lt',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Sl_Tar');
$amb->cargarTituloObjeto('un Sl_Tar');
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
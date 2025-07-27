<?php
include_once ("Clases/St_Lot.php");
include_once ("Clases/AMB.php");
$st_lot = new St_Lot();
$OBJETO = 'St_Lot';
$SUBOBJETO=$OBJETO;
$amb = new AMB('St_Lot');
$CAMPOS = array('id','prod_sl','marc_sl','enva_sl','cenv_sl','tipo_sl','esta_sl','fech_sl','lotc_sl','lotc_slt','lotn_sl','esti_sl','defi_sl','prec_sl','prio_sl','obse_sl','desp_sl','desl_sl','emay_sl','cmay_sl','crea_sl','nrea_sl','desn_sl','dola_sl','tcfi_sl','otav_sl','dens_sl','fveo_sl','rere_sl','orig_sl','pote_sl','habi_sl','emen_sl','cmen_sl','innu_sl','cdoc_sl','ndoc_sl','toke_sl','sect_sl','sect_slt','cert_sl','rloc_sl','rlon_sl','part_sl','fven_sl','tcad_sl','conm_sl','conm_slt','tilo_sl','tilo_slt','cosf_sl','cete_sl','nete_sl','menc_sl','lvin_sl','lvin_slt','nsap_sl','fill_sl',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el St_Lot');
$amb->cargarTituloObjeto('un St_Lot');
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
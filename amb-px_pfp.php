<?php
include_once ("Clases/Px_Pfp.php");
include_once ("Clases/AMB.php");
$px_pfp = new Px_Pfp();
$OBJETO = 'Px_Pfp';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Px_Pfp');
$CAMPOS = array('id','pend_lq','ftur_lq','htur_lq','orde_lq','esta_lq','esta_lqt','cmov_lq','nmov_lq','tipo_lq','tipo_lqt','erro_lq','erro_lqt','errn_lq','opem_lq','opem_lqt','pemb_lq','tlod_lq','tlod_lqt','fech_lq','form_lq','lotc_lq','lotc_lqt','lotn_lq','cdis_lq','cdis_lqt','ndis_lq','cdid_lq','cdid_lqt','ndid_lq','cdoc_lq','ndoc_lq','proe_lq','mare_lq','enve_lq','cene_lq','cane_lq','cemb_lq','cant_lq','cori_lq','prod_lq','marc_lq','enva_lq','cenv_lq','cfor_lq','nfor_lq','fetu_lq','hetu_lq','fefi_lq','hefi_lq','nuca_lq','cdo1_lq','ndo1_lq','hold_lq','hold_lqt','toke_lq','sect_lq','sect_lqt','caru_lq','crem_lq','caco_lq','repl_lq','taru_lq','taru_lqt','line_lq','line_lqt','depo_lq','aufa_lq','fill_lq',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Px_Pfp');
$amb->cargarTituloObjeto('un Px_Pfp');
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
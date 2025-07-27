<?php
include_once ("Clases/St_Art.php");
include_once ("Clases/AMB.php");
$st_art = new St_Art();
$OBJETO = 'St_Art';
$SUBOBJETO=$OBJETO;
$amb = new AMB('St_Art');
$CAMPOS = array('id','prod_sa','marc_sa','enva_sa','cenv_sa','cenr_sa','cceu_sa','pmin_sa','spro_sa','smar_sa','senv_sa','scen_sa','soco_sa','cant_sa','habi_sa','prio_sa','arge_sa','enca_sa','ccap_sa','pall_sa','paan_sa','pala_sa','caan_sa','cala_sa','caal_sa','insp_sa','insm_sa','inse_sa','insc_sa','uceu_sa','impo_sa','desv_sa','sena_sa','soli_sa','pimi_sa','repo_sa','tusp_sa','iinv_sa','ppro_sa','pmar_sa','penv_sa','pcen_sa','dens_sa','enan_sa','enla_sa','enal_sa','peen_sa','drep_sa','paip_sa','tran_sa','etiq_sa','ckos_sa');
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el St_Art');
$amb->cargarTituloObjeto('un St_Art');
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
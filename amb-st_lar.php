<?php
include_once ("Clases/St_Lar.php");
include_once ("Clases/AMB.php");
$st_lar = new St_Lar();
$OBJETO = 'St_Lar';
$SUBOBJETO=$OBJETO;
$amb = new AMB('St_Lar');
$CAMPOS = array('id','prod_gd','marc_gd','enva_gd','cenv_gd','cmov_gd','nmov_gd','item_gd','site_gd','cant_gd','prec_gd','sape_gd','sapf_gd','cost_gd','refe_gd','tenv_gd','forn_gd','nfor_gd','moti_gd','itom_gd','cdo1_gd','ndo1_gd','cdo2_gd','ndo2_gd','ndo3_gd','exca_gd','cete_gd','nete_gd','tipo_gd','val1_gd','val2_gd','val3_gd','val4_gd','val5_gd','cprr_gd','nprr_gd','marr_gd','envr_gd','cenr_gd','fill_gd',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el St_Lar');
$amb->cargarTituloObjeto('un St_Lar');
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
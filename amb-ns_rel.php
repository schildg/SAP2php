<?php
include_once ("Clases/Ns_Rel.php");
include_once ("Clases/AMB.php");
$ns_rel = new Ns_Rel();
$OBJETO = 'Ns_Rel';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Ns_Rel');
$CAMPOS = array('id','tipo_ns','cdoc_ns','ndoc_ns','item_ns','site_ns','cmov_ns','nmov_ns','tip1_ns','prod_ns','marc_ns','enva_ns','cenv_ns','cmo1_ns','nmo1_ns','tip2_ns','csap_ns','nsap_ns','cmo2_ns','nmo2_ns');
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Ns_Rel');
$amb->cargarTituloObjeto('un Ns_Rel');
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
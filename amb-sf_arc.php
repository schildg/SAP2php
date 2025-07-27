<?php
include_once ("Clases/Sf_Arc.php");
include_once ("Clases/AMB.php");
$sf_arc = new Sf_Arc();
$OBJETO = 'Sf_Arc';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Sf_Arc');
$CAMPOS = array('id','nreg_sf','letr_sf','nume_sf','nfa1_sf','nfa2_sf','nfa3_sf','nfa4_sf','nlar_sf','desc_sf','obse_sf','hist_sf','nove_sf','tipo_sf','habi_sf','cmo1_sf','cmo2_sf','cmo3_sf','nmo1_sf','nmo2_sf','nmo3_sf','nmo4_sf','des1_sf','des2_sf','des3_sf','des4_sf','list_sf','cabe_sf','gene_sf','cnts_sf','nodw_sf');
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Sf_Arc');
$amb->cargarTituloObjeto('un Sf_Arc');
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
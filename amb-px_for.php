<?php
include_once ("Clases/Px_For.php");
include_once ("Clases/AMB.php");
$px_for = new Px_For();
$OBJETO = 'Px_For';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Px_For');
$CAMPOS = array('id','prod_lv','form_lv','cmov_lv','nmov_lv','nomb_lv','fech_lv','suma_lv','exci_lv','habi_lv','habi_lvt','cdor_lv','cost_lv','ubue_lv','tipo_lv','tipo_lvt','mezc_lv','mini_lv','pace_lv','maxi_lv','toke_lv','cadi_lv','cfor_lv','fcof_lv','line_lv','line_lvt','firm_lv','firm_lvt','fill_lv',);
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Px_For');
$amb->cargarTituloObjeto('un Px_For');
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
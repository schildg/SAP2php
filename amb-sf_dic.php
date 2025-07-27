<?php
include_once ("Clases/Sf_Dic.php");
include_once ("Clases/AMB.php");
$sf_dic = new Sf_Dic();
$OBJETO = 'Sf_Dic';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Sf_Dic');
$CAMPOS = array('id','letr_di','line_di','nomb_di','nive_di','sign_di','tipo_di','long_di','deci_di','clas_di','comp_di','occu_di','indi_di','desc_di','cond_di','crel_di','then_di','else_di','acce_di','vocc_di','nove_di','list_di','geta_di','deau_di','repe_di','dwho_di','nuno_di','cfun_di','nfun_di','saln_di','salx_di');
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el Diccionario Anita');
$amb->cargarTituloObjeto('un Diccionario Anita');
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
<?php
include_once ("Clases/Diccionario.php");
include_once ("Clases/AMB.php");
$diccionario = new Diccionario();
$OBJETO = 'Diccionario';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Diccionario');
$CAMPOS = array('id','objeto','campo','gene_historia','leye_historia','objeto_foraneo','campo_foraneo','es_unico','es_foraneo','leyenda','ayuda','descripcion');
$amb->cargarCampos($CAMPOS);
$amb->cargarTitulo('Datos de los campos en el diccionario de datos ');
$amb->cargarTituloObjeto('un Campo en el diccionario de datos');
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
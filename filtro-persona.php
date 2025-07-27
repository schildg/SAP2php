<?php
include_once ("Clases/Persona.php");
$smarty = new Smarty();
$persona = new Persona();
$OBJETO = 'Persona';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','Nombre','Apellido','DNI','fecha_nac','Sexo','G_sanguineo','localidad_id','Es_Alumno','Es_Docente','Es_Tutor');

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de las Personas");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aPersonas = $persona->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aPersonas);

$smarty->display('ListadorDeDatos.tpl');
?>
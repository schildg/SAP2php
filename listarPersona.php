<?php
include_once ("Clases/Persona.php");
$persona = new Persona();

$OBJETO='Persona';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','Nombre','Apellido','DNI','fecha_nac','Sexo','G_sanguineo','localidad_id','Es_Alumno','Es_Docente','Es_Tutor');

include_once ("datos-listador.php");

$smarty->assign("objeto", $persona);

$aPersonas = $persona->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aPersonas);

$smarty->assign("titulo", "Listado de las Personas");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
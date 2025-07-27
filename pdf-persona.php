<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Persona.php");

$pdf=new PDF();

$OBJETO='Persona';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','Nombre','Apellido','DNI','fecha_nac','Sexo','G_sanguineo','localidad_id','Es_Alumno','Es_Docente','Es_Tutor');

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
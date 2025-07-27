<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Persona.php");

$pdf=new PDF();

$OBJETO='Persona';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','Nombre','Apellido','DNI','fecha_nac','Sexo','G_sanguineo','localidad_id','Es_Alumno','Es_Docente','Es_Tutor');

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
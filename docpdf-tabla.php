<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Tabla.php");

$pdf=new PDF();

$OBJETO='Tabla';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','campo','numero','habilitado','nombre','noco','objeto');

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
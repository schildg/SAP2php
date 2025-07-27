<?php
include_once ("Clases/PDF.php");
include_once ("Clases/St_Doc.php");

$pdf=new PDF();

$OBJETO='St_Doc';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','esta_sd','clie_sd','fech_sd','cmov_sd',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
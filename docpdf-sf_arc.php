<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Sf_Arc.php");

$pdf=new PDF();

$OBJETO='Sf_Arc';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','nreg_sf','letr_sf','nume_sf','nfa1_sf',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
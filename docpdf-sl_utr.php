<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Sl_Utr.php");

$pdf=new PDF();

$OBJETO='Sl_Utr';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','diac_lu','esta_lu','esta_lut','lotc_lu',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
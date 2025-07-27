<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Sl_Tar.php");

$pdf=new PDF();

$OBJETO='Sl_Tar';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','cdoc_lt','ndoc_lt','item_lt','esta_lt',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
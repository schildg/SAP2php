<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Condicion_Pago.php");

$pdf=new PDF();

$OBJETO='Condicion_Pago';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','ZTERM','ZTAGG','ZDART','ZFAEL',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
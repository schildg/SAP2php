<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Recibo_CRM.php");

$pdf=new PDF();

$OBJETO='Recibo_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','BUKRS','BELNR','GJAHR','BLART',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
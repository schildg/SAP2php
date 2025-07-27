<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Cheques.php");

$pdf=new PDF();

$OBJETO='Cheques';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','BUKRS','NCHCK','BLDAT','BELNR',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
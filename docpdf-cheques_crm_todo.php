<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Cheques_CRM_TODO.php");

$pdf=new PDF();

$OBJETO='Cheques_CRM_TODO';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','CRM_ID','BUKRS','NCHCK','BLDAT',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
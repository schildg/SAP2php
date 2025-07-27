<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Cliente_CRM.php");

$pdf=new PDF();

$OBJETO='Cliente_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','CRM_ID','KUNNR','VKORG','VTWEG',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
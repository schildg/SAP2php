<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Venta_CRM.php");

$pdf=new PDF();

$OBJETO='Venta_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','KUNNR','MATNR','KUNN2','VKORG',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
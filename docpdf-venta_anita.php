<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Venta_Anita.php");

$pdf=new PDF();

$OBJETO='Venta_Anita';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','CRM_ID','KUNNR','MATNR','KUNN2',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
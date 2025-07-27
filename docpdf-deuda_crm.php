<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Deuda_CRM.php");

$pdf=new PDF();

$OBJETO='Deuda_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','FECHA','CODIGO_PAIS','BLART','VBELN',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Factura_CRM.php");

$pdf=new PDF();

$OBJETO='Factura_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','VBELN','WAERK','VKORG','VTWEG',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
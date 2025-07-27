<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Operacion.php");

$pdf=new PDF();

$OBJETO='Operacion';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','AUFNR','ROUTING_NO','COUNTER','SEQUENCE_NO',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
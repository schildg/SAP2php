<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Componente.php");

$pdf=new PDF();

$OBJETO='Componente';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','RESERVATION_NUMBER','RESERVATION_ITEM','RESERVATION_TYPE','DELETION_INDICATOR',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
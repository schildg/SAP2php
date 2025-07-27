<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Ns_Rel.php");

$pdf=new PDF();

$OBJETO='Ns_Rel';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','tipo_ns','cdoc_ns','ndoc_ns','item_ns',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
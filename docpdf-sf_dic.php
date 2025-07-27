<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Sf_Dic.php");

$pdf=new PDF();

$OBJETO='Sf_Dic';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','letr_di','line_di','nomb_di','nive_di',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
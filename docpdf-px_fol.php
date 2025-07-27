<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Px_Fol.php");

$pdf=new PDF();

$OBJETO='Px_Fol';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','prod_ll','cmov_ll','nmov_ll','item_ll',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
<?php
include_once ("Clases/PDF.php");
include_once ("Clases/St_Rld.php");

$pdf=new PDF();

$OBJETO='St_Rld';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','cmov_sr','nmov_sr','item_sr','pro1_sr',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
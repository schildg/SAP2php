<?php
include_once ("Clases/PDF.php");
include_once ("Clases/St_Mar.php");

$pdf=new PDF();

$OBJETO='St_Mar';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','desc_sm','marc_sm','deco_sm','habi_sm',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
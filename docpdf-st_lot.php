<?php
include_once ("Clases/PDF.php");
include_once ("Clases/St_Lot.php");

$pdf=new PDF();

$OBJETO='St_Lot';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','prod_sl','marc_sl','enva_sl','cenv_sl',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
<?php
include_once ("Clases/PDF.php");
include_once ("Clases/St_Lar.php");

$pdf=new PDF();

$OBJETO='St_Lar';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','prod_gd','marc_gd','enva_gd','cenv_gd',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
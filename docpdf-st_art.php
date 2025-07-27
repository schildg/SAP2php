<?php
include_once ("Clases/PDF.php");
include_once ("Clases/St_Art.php");

$pdf=new PDF();

$OBJETO='St_Art';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','prod_sa','marc_sa','enva_sa','cenv_sa',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
<?php
include_once ("Clases/PDF.php");
include_once ("Clases/St_Pro.php");

$pdf=new PDF();

$OBJETO='St_Pro';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','desc_sp','prod_sp','desv_sp','unid_sp',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
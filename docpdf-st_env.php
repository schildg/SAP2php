<?php
include_once ("Clases/PDF.php");
include_once ("Clases/St_Env.php");

$pdf=new PDF();

$OBJETO='St_Env';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','desc_se','enva_se','deco_se','habi_se',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
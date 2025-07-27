<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Ut_Hu.php");

$pdf=new PDF();

$OBJETO='Ut_Hu';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','cmov_lu','nmov_lu','AUFNR','EXIDV_OB',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
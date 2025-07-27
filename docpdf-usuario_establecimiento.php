<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Usuario_Establecimiento.php");

$pdf=new PDF();

$OBJETO='Usuario_Establecimiento';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','usuario_id','establecimiento_id');

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
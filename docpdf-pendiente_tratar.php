<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Pendiente_Tratar.php");

$pdf=new PDF();

$OBJETO='Pendiente_Tratar';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','objeto','id_objeto','estado','codigo',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
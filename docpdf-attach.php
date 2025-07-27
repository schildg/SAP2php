<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Attach.php");

$pdf=new PDF();

$OBJETO='Attach';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','objeto','objeto_id','mime','nombre','tmp_name');

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Accion.php");

$pdf=new PDF();

$OBJETO='Accion';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','comando','descripcion','fecha','habilitado','modulo','rotulo');

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Establecimiento.php");

$pdf=new PDF();

$OBJETO='Establecimiento';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','nombre','direccion','tipo','nivel','localidad_id','logo_1','logo_2');

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
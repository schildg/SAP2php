<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Menu.php");

$pdf=new PDF();

$OBJETO='Menu';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','tipo_menu','denominacion','habilitado');

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
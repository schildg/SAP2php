<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Almacen.php");

$pdf=new PDF();

$OBJETO='Almacen';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','WERKS','LGORT','LGOBE','SPART',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Posicion.php");

$pdf=new PDF();

$OBJETO='Posicion';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','ORDER_NUMBER','ORDER_ITEM_NUMBER','SALES_ORDER','SALES_ORDER_ITEM',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
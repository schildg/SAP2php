<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Posicion.php");

$pdf=new PDF();

$OBJETO='Posicion';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','ORDER_NUMBER','ORDER_ITEM_NUMBER','SALES_ORDER','SALES_ORDER_ITEM',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
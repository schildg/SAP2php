<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Almacen.php");

$pdf=new PDF();

$OBJETO='Almacen';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','WERKS','LGORT','LGOBE','SPART',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Sl_Tar.php");

$pdf=new PDF();

$OBJETO='Sl_Tar';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','cdoc_lt','ndoc_lt','item_lt','esta_lt',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
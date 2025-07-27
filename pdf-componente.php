<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Componente.php");

$pdf=new PDF();

$OBJETO='Componente';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','RESERVATION_NUMBER','RESERVATION_ITEM','RESERVATION_TYPE','DELETION_INDICATOR',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
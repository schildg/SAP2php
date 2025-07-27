<?php
include_once ("Clases/PDF.php");
include_once ("Clases/St_Doc.php");

$pdf=new PDF();

$OBJETO='St_Doc';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','esta_sd','clie_sd','fech_sd','cmov_sd',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Sl_Utr.php");

$pdf=new PDF();

$OBJETO='Sl_Utr';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','diac_lu','esta_lu','esta_lut','lotc_lu',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
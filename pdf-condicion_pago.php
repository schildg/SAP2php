<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Condicion_Pago.php");

$pdf=new PDF();

$OBJETO='Condicion_Pago';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','ZTERM','ZTAGG','ZDART','ZFAEL',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
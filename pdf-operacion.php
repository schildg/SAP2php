<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Operacion.php");

$pdf=new PDF();

$OBJETO='Operacion';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','AUFNR','ROUTING_NO','COUNTER','SEQUENCE_NO',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
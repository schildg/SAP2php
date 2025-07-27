<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Accion.php");

$pdf=new PDF();

$OBJETO='Accion';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','comando','descripcion','fecha','habilitado','modulo','rotulo');

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
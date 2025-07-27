<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Tabla.php");

$pdf=new PDF();

$OBJETO='Tabla';
$SUBOBJETO=$OBJETO;
$amb = new AMB('Tabla');
$CAMPOS = array('id','campo','numero','habilitado','nombre','noco','objeto');

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
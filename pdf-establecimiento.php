<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Establecimiento.php");

$pdf=new PDF();

$OBJETO='Establecimiento';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','nombre','direccion','tipo','nivel','localidad_id','logo_1','logo_2');

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Menu.php");

$pdf=new PDF();

$OBJETO='Menu';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','tipo_menu','denominacion','habilitado');

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
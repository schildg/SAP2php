<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Usuario_Establecimiento.php");

$pdf=new PDF();

$OBJETO='Usuario_Establecimiento';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','usuario_id','establecimiento_id');

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
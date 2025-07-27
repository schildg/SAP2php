<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Pendiente_Tratar.php");

$pdf=new PDF();

$OBJETO='Pendiente_Tratar';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','objeto','id_objeto','estado','codigo',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
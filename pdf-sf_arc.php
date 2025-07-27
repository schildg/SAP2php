<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Sf_Arc.php");

$pdf=new PDF();

$OBJETO='Sf_Arc';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','nreg_sf','letr_sf','nume_sf','nfa1_sf',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
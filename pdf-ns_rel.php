<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Ns_Rel.php");

$pdf=new PDF();

$OBJETO='Ns_Rel';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','tipo_ns','cdoc_ns','ndoc_ns','item_ns',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
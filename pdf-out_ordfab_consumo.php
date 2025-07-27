<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Out_OrdFab_Consumo.php");

$pdf=new PDF();

$OBJETO='Out_OrdFab_Consumo';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','AUFNR','RSPOS','MATNR','WERKS',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
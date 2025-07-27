<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Out_GoodsMvment.php");

$pdf=new PDF();

$OBJETO='Out_GoodsMvment';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','AUFNR','MATNR','TEXT_MSEG_MATNR','WERKS',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
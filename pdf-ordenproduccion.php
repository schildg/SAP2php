<?php
include_once ("Clases/PDF.php");
include_once ("Clases/OrdenProduccion.php");

$pdf=new PDF();

$OBJETO='OrdenProduccion';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','ORDER_NUMBER','PRODUCTION_PLANT','MRP_CONTROLLER','PRODUCTION_SCHEDULER',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Venta_CRM.php");

$pdf=new PDF();

$OBJETO='Venta_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','KUNNR','MATNR','KUNN2','VKORG',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
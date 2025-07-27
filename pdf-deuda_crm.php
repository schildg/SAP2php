<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Deuda_CRM.php");

$pdf=new PDF();

$OBJETO='Deuda_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','FECHA','CODIGO_PAIS','BLART','VBELN',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
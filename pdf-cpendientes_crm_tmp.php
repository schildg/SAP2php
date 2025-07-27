<?php
include_once ("Clases/PDF.php");
include_once ("Clases/CPendientes_CRM_TMP.php");

$pdf=new PDF();

$OBJETO='CPendientes_CRM_TMP';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','BUKRS','EBELN','EBELP','EKORG',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
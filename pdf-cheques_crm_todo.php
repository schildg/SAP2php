<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Cheques_CRM_TODO.php");

$pdf=new PDF();

$OBJETO='Cheques_CRM_TODO';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','CRM_ID','BUKRS','NCHCK','BLDAT',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
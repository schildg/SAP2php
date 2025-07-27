<?php
include_once ("Clases/PDF.php");
include_once ("Clases/PPendiente_CRM_TODO.php");

$pdf=new PDF();

$OBJETO='PPendiente_CRM_TODO';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','BUKRS','CRM_ID','AUART','VBELN',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Out_EmHu_OrdFab.php");

$pdf=new PDF();

$OBJETO='Out_EmHu_OrdFab';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','AUFNR','tarea','MATNRHU','QUANTITY',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
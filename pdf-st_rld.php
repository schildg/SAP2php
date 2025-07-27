<?php
include_once ("Clases/PDF.php");
include_once ("Clases/St_Rld.php");

$pdf=new PDF();

$OBJETO='St_Rld';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','cmov_sr','nmov_sr','item_sr','pro1_sr',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
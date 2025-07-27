<?php
include_once ("Clases/PDF.php");
include_once ("Clases/St_Mar.php");

$pdf=new PDF();

$OBJETO='St_Mar';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','desc_sm','marc_sm','deco_sm','habi_sm',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
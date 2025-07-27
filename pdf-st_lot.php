<?php
include_once ("Clases/PDF.php");
include_once ("Clases/St_Lot.php");

$pdf=new PDF();

$OBJETO='St_Lot';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','prod_sl','marc_sl','enva_sl','cenv_sl',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Px_For.php");

$pdf=new PDF();

$OBJETO='Px_For';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','prod_lv','form_lv','cmov_lv','nmov_lv',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
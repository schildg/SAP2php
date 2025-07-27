<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Px_Fol.php");

$pdf=new PDF();

$OBJETO='Px_Fol';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','prod_ll','cmov_ll','nmov_ll','item_ll',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
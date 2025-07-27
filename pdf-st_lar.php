<?php
include_once ("Clases/PDF.php");
include_once ("Clases/St_Lar.php");

$pdf=new PDF();

$OBJETO='St_Lar';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','prod_gd','marc_gd','enva_gd','cenv_gd',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
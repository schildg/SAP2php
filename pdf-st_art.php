<?php
include_once ("Clases/PDF.php");
include_once ("Clases/St_Art.php");

$pdf=new PDF();

$OBJETO='St_Art';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','prod_sa','marc_sa','enva_sa','cenv_sa',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
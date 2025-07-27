<?php
include_once ("Clases/PDF.php");
include_once ("Clases/St_Pro.php");

$pdf=new PDF();

$OBJETO='St_Pro';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','desc_sp','prod_sp','desv_sp','unid_sp',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
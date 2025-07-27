<?php
include_once ("Clases/PDF.php");
include_once ("Clases/St_Env.php");

$pdf=new PDF();

$OBJETO='St_Env';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','desc_se','enva_se','deco_se','habi_se',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
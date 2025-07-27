<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Ut_Hu.php");

$pdf=new PDF();

$OBJETO='Ut_Hu';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','cmov_lu','nmov_lu','AUFNR','EXIDV_OB',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
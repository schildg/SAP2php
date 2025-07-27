<?php
include_once ("Clases/PDF.php");
include_once ("Clases/CabeceraMovimientoMaterial.php");

$pdf=new PDF();

$OBJETO='CabeceraMovimientoMaterial';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MAT_DOC','DOC_YEAR','TR_EV_TYPE','PSTNG_DATE',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
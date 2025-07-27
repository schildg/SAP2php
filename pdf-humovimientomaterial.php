<?php
include_once ("Clases/PDF.php");
include_once ("Clases/HUMovimientoMaterial.php");

$pdf=new PDF();

$OBJETO='HUMovimientoMaterial';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MAT_DOC','DOC_YEAR','MATNR','CHARG',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
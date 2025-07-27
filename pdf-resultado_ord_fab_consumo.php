<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Resultado_ORD_FAB_Consumo.php");

$pdf=new PDF();

$OBJETO='Resultado_ORD_FAB_Consumo';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','TYPE','ID_SAP','NUMBER','MESSAGE',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
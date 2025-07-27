<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Clase_Movimiento.php");

$pdf=new PDF();

$OBJETO='Clase_Movimiento';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','clase_movimiento','nombre','signo_para_anita',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
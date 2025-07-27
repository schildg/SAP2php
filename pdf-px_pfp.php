<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Px_Pfp.php");

$pdf=new PDF();

$OBJETO='Px_Pfp';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','pend_lq','ftur_lq','htur_lq','orde_lq',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
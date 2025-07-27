<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Cheques.php");

$pdf=new PDF();

$OBJETO='Cheques';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','BUKRS','NCHCK','BLDAT','BELNR',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
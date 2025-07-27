<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Estruc_TrasabCob.php");

$pdf=new PDF();

$OBJETO='Estruc_TrasabCob';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','ZNREC','ZFCON','ZFDOC','ZIMPO',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
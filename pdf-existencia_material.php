<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Existencia_Material.php");

$pdf=new PDF();

$OBJETO='Existencia_Material';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MATNR','WERKS','LGORT','PSTAT',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
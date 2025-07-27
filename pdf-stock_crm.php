<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Stock_CRM.php");

$pdf=new PDF();

$OBJETO='Stock_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MATNR','WERKS','LGORT','LABST',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
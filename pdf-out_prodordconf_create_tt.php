<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Out_ProdOrdConf_Create_TT.php");

$pdf=new PDF();

$OBJETO='Out_ProdOrdConf_Create_TT';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','CONF_NO','ORDERID','SEQUENCE','OPERATION',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
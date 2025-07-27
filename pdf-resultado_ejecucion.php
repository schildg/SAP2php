<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Resultado_Ejecucion.php");

$pdf=new PDF();

$OBJETO='Resultado_Ejecucion';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','RFC','id_objeto_sap','TYPE','ID_SAP',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
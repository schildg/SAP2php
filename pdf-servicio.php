<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Servicio.php");

$pdf=new PDF();

$OBJETO='Servicio';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','nombre_servicio','estado','secuencia','paquete',);

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
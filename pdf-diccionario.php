<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Diccionario.php");

$pdf=new PDF();

$OBJETO='Diccionario';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','objeto','campo','gene_historia','leye_historia','objeto_foraneo','campo_foraneo','es_unico','es_foraneo','leyenda','ayuda','descripcion');

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
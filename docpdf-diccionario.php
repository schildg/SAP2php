<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Diccionario.php");

$pdf=new PDF();

$OBJETO='Diccionario';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','objeto','campo','gene_historia','leye_historia','objeto_foraneo','campo_foraneo','es_unico','es_foraneo','leyenda','ayuda','descripcion');

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
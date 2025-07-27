<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Servicio.php");

$pdf=new PDF();

$OBJETO='Servicio';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','nombre_servicio','estado','secuencia','paquete',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
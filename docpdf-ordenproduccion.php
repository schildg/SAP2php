<?php
include_once ("Clases/PDF.php");
include_once ("Clases/OrdenProduccion.php");

$pdf=new PDF();

$OBJETO='OrdenProduccion';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','ORDER_NUMBER','PRODUCTION_PLANT','MRP_CONTROLLER','PRODUCTION_SCHEDULER',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
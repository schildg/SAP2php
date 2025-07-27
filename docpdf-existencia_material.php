<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Existencia_Material.php");

$pdf=new PDF();

$OBJETO='Existencia_Material';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MATNR','WERKS','LGORT','PSTAT',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
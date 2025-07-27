<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Out_GoodsMvment.php");

$pdf=new PDF();

$OBJETO='Out_GoodsMvment';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','AUFNR','MATNR','TEXT_MSEG_MATNR','WERKS',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
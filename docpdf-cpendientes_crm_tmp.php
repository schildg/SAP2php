<?php
include_once ("Clases/PDF.php");
include_once ("Clases/CPendientes_CRM_TMP.php");

$pdf=new PDF();

$OBJETO='CPendientes_CRM_TMP';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','BUKRS','EBELN','EBELP','EKORG',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
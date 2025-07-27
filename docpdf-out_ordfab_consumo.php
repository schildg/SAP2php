<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Out_OrdFab_Consumo.php");

$pdf=new PDF();

$OBJETO='Out_OrdFab_Consumo';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','AUFNR','RSPOS','MATNR','WERKS',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
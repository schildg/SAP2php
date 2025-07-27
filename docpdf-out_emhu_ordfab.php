<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Out_EmHu_OrdFab.php");

$pdf=new PDF();

$OBJETO='Out_EmHu_OrdFab';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','AUFNR','tarea','MATNRHU','QUANTITY',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
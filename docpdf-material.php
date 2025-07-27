<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Material.php");

$pdf=new PDF();

$OBJETO='Material';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MATNR','ERSDA','ERNAM','LAEDA',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
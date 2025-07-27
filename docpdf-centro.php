<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Centro.php");

$pdf=new PDF();

$OBJETO='Centro';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','WERKS','NAME1','BWKEY','KUNNR',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
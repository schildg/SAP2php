<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Stock_CRM.php");

$pdf=new PDF();

$OBJETO='Stock_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MATNR','WERKS','LGORT','LABST',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
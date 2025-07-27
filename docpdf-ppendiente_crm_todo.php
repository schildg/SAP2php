<?php
include_once ("Clases/PDF.php");
include_once ("Clases/PPendiente_CRM_TODO.php");

$pdf=new PDF();

$OBJETO='PPendiente_CRM_TODO';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','BUKRS','CRM_ID','AUART','VBELN',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
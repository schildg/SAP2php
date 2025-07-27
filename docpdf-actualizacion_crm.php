<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Actualizacion_CRM.php");

$pdf=new PDF();

$OBJETO='Actualizacion_CRM';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','Objeto','Ultima_Actualizacion',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
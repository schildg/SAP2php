<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Clase_Movimiento.php");

$pdf=new PDF();

$OBJETO='Clase_Movimiento';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','clase_movimiento','nombre','signo_para_anita',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
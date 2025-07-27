<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Px_Pfp.php");

$pdf=new PDF();

$OBJETO='Px_Pfp';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','pend_lq','ftur_lq','htur_lq','orde_lq',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Estruc_TrasabCob.php");

$pdf=new PDF();

$OBJETO='Estruc_TrasabCob';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','ZNREC','ZFCON','ZFDOC','ZIMPO',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
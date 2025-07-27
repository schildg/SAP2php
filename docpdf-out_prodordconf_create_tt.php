<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Out_ProdOrdConf_Create_TT.php");

$pdf=new PDF();

$OBJETO='Out_ProdOrdConf_Create_TT';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','CONF_NO','ORDERID','SEQUENCE','OPERATION',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
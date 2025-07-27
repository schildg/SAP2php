<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Usuario.php");

$pdf=new PDF();

$OBJETO='Usuario';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','Nombre','Apellido','login','email','habilitado','menu_id');

include_once("datos-pdf.php");

$ECEPCCION=array('pws');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
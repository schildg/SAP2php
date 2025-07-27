<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Permiso.php");

$pdf=new PDF();

$OBJETO='Permiso';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','usuario_id','accion_id','habilitado');

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
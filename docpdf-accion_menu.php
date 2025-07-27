<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Accion_Menu.php");

$pdf=new PDF();

$OBJETO='Accion_Menu';

include_once("datos-pdf.php");

$SUBOBJETO=$OBJETO;
$CAMPOS=array('id','menu_id','accion_id','habilitado');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$CAMPOS,$OBJETO);
$pdf->Output();

?>
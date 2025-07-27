<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Accion_Menu.php");

$pdf=new PDF();

$OBJETO='Accion_Menu';
$SUBOBJETO=$OBJETO;
$CAMPOS=array('id','menu_id','accion_id','habilitado');

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
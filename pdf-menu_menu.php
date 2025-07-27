<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Menu_Menu.php");

$pdf=new PDF();

$OBJETO='Menu_Menu';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','menu_id','menu_id1','habilitado');

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Usuario.php");

$pdf=new PDF();

$OBJETO='Usuario';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','Nombre','Apellido','login','email','habilitado','menu_id');

include_once("datos-pdf.php");

$data=$pdf->LoadData($OBJETO,$QUERY_FILTRO,$SELECCION);
$header=$pdf->LoadHeader($OBJETO,$SELECCION);
$pdf->SetFont('Courier','',	10);
$pdf->FancyTable($header,$data,$SELECCION,$OBJETO);
$pdf->Output();

?>
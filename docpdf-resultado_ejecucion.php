<?php
include_once ("Clases/PDF.php");
include_once ("Clases/Resultado_Ejecucion.php");

$pdf=new PDF();

$OBJETO='Resultado_Ejecucion';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','RFC','id_objeto_sap','TYPE','ID_SAP',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
<?php
include_once ("Clases/PDF.php");
include_once ("Clases/LineaMovimientoMaterial.php");

$pdf=new PDF();

$OBJETO='LineaMovimientoMaterial';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MAT_DOC','DOC_YEAR','VEMNG','VEMEH',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
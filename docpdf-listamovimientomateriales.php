<?php
include_once ("Clases/PDF.php");
include_once ("Clases/ListaMovimientoMateriales.php");

$pdf=new PDF();

$OBJETO='ListaMovimientoMateriales';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MAT_DOC','DOC_YEAR','TR_EV_TYPE','PSTNG_DATE',);

include_once("datos-pdf.php");

$ECEPCCION=array('');
$id=$_GET["id"];
$pdf->SetFont('Courier','',	10);
$pdf->DocPDF($id,$ECEPCCION,$OBJETO);
$pdf->Output();

?>
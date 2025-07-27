<?php
include_once ("Clases/Tabla.php");
$tabla = new Tabla();
$smarty  = new Smarty();
if (isset ($_GET['orden'])) {
	$orden=$_GET['orden'];
	$campoorden=$_GET['campoorden'];
	$ORDEN=$campoorden." ".$orden;
}else{
	$ORDEN='id';
};

$colu= MyActiveRecord::Columns($OBJETO);
$columna=array();
foreach ($colu as $k => $v) {
	if (in_array($k,$CAMPOS) and $k!='date_concurrency'){
		$columna[$k]=$v;
	}
}



$smarty->assign("exportarPlanCal", $exportarPlanCal);
$smarty->assign("tipoListado", 'listar');
$smarty->assign("columna", $columna);
$smarty->assign("tabla", $tabla);
$smarty->assign("OBJETO", $OBJETO);
$smarty->assign("SUBOBJETO", $SUBOBJETO);
$smarty->assign("Accion", $accion);

$smarty->assign("self", $self);
?>
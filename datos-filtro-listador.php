<?php
if (isset ($_GET['orden'])) {
	$orden=$_GET['orden'];
	$campoorden=$_GET['campoorden'];
	$ORDEN=$campoorden." ".$orden;
}else{
	$ORDEN='id';
};

$columna= MyActiveRecord::Columns($OBJETO);
$colu=array();
foreach ($columna as $k => $v) {
	if($sel[$k]){
		$colu[$k]=$v;
	}
}


$smarty->assign("tipoListado", 'filtro');
$smarty->assign("columna", $colu);
$smarty->assign("OBJETO", $OBJETO);
$smarty->assign("SUBOBJETO", $SUBOBJETO);
?>
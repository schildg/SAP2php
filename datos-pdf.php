<?php
if (isset($_SESSION["filtro-$SUBOBJETO"])){

	$var1= $_SESSION["filtro-$SUBOBJETO"];
	$var2= $_SESSION["seleccion-$SUBOBJETO"];
	$var3= $_SESSION["datos-$SUBOBJETO"];
	$QUERY_FILTRO= $_SESSION["query-$SUBOBJETO"];
	$columna= MyActiveRecord::Columns($OBJETO);
	$sel1=array('id');
	$SEL = new ArrayObject($sel1);
	$SELECCION = $SEL->getIterator();
    foreach($var2 as $k => $v){
    	$SELECCION->$k=$v;
    }
	$filtro1=array();
	$FILTRO = new ArrayObject($filtro1);
	$filtro = $FILTRO->getIterator();
	foreach ($var1 as $k => $v) {
    	$filtro->$k=$v;
    }
	$colu= MyActiveRecord::Columns($OBJETO);
	$obj=array();
	foreach ($colu as $k => $v) {
			$objeto->$k=$var3[$k];
	}
}
?>

<?php
include_once ("Clases/Tabla.php");
$tabla = new Tabla();

$columna= MyActiveRecord::Columns($OBJETO);
$objeto= MyActiveRecord::Create($OBJETO);
foreach ($columna as $k => $v) {
	if(isset($_POST["$k"])){
		if($objeto->GetType($OBJETO,$k)=="date"){
		    $objeto->$k=strtodate($_POST[$k]);
		}else{	
			$objeto->$k = $_POST["$k"];
		}
	}
}
$smarty->assign("objeto", $objeto);

if(isset($_POST["accion"]) or (isset($_GET["accion"]) and !isset($_SESSION["filtro-$SUBOBJETO"]))){
	$columna= MyActiveRecord::Columns($OBJETO);
	$tieneUno=0;
	$sel=array();
	foreach ($columna as $k => $v) {
		if(isset($_POST["sel-$k"])){
			if($_POST["sel-$k"]=="on"){
				$sel[$k]=true;
				$tieneUno=true;
			}else{	
				$sel[$k]=false;
			}
		}
	}
    if(!$tieneUno){
		foreach ($columna as $k => $v) {
			if (in_array($k,$CAMPOS)){
				$sel[$k]=true;
			}
		}
    };	
	
	$i=0;
	$filtro=array();
	foreach ($columna as $k => $v) {
		$filtro[$k]=$_POST["filtro-$k"];
		if ($filtro[$k] !=''){
			if($i==0){
				if ($filtro[$k]=='LIKE'){
					$QUERY_FILTRO=$k." ".$filtro[$k]." "."'%".$objeto->$k."%'";
					$i++;
				}else{
					$QUERY_FILTRO=$k." ".$filtro[$k]." "."'".$objeto->$k."'";
					$i++;
				}
			}else{
				if($filtro[$k]=='LIKE'){
					$QUERY_FILTRO=$QUERY_FILTRO." and ".$k." ".$filtro[$k]." "."'%".$objeto->$k."%'";										
				}else{
					$QUERY_FILTRO=$QUERY_FILTRO." and ".$k." ".$filtro[$k]." "."'".$objeto->$k."'";						
				}
			}
		}
	}
	$obj=array();
	foreach ($columna as $k => $v) {
		if (in_array($k,$CAMPOS)){
			$obj[$k]=$objeto->$k;
		}
	}
	
	$relacion= MyActiveRecord::Create($OBJETO);
	$colu=array();
	foreach ($columna as $k => $v) {
		if (in_array($k,$CAMPOS) and $k!='date_concurrency'){
			$colu[$k]=$v;
		}
	}
	$_SESSION["filtro-$SUBOBJETO"]=$filtro;
	$_SESSION["seleccion-$SUBOBJETO"]=$sel;
	$_SESSION["datos-$SUBOBJETO"]=$obj;
	$_SESSION["query-$SUBOBJETO"]=$QUERY_FILTRO;
}else{
	if (isset($_SESSION["filtro-$SUBOBJETO"])){
		$var1= $_SESSION["filtro-$SUBOBJETO"];
		$var2= $_SESSION["seleccion-$SUBOBJETO"];
		$var3= $_SESSION["datos-$SUBOBJETO"];
		$QUERY_FILTRO= $_SESSION["query-$SUBOBJETO"];
		$columna= MyActiveRecord::Columns($OBJETO);
		$sel=array();
		foreach ($var2 as $k => $v) {
			$sel[$k]=$v;
		};	
		$filtro=array();
		foreach ($var1 as $k => $v) {
			if (in_array($k,$CAMPOS)){
				$filtro[$k]=$v;
			}
		};	
		$relacion= MyActiveRecord::Create($OBJETO);
		$colu=array();
		foreach ($columna as $k => $v) {
			if (in_array($k,$CAMPOS)){
				$colu[$k]=$v;
			}
		}
		$obj=array();
		foreach ($columna as $k => $v) {
				$objeto->$k=$var3[$k];
		}
	}
}


$smarty->assign("tipoListado", 'filtro');
$smarty->assign("exportarPlanCal", $exportarPlanCal);
$smarty->assign("sel", $sel);
$smarty->assign("filtro", $filtro);
$smarty->assign("columna", $colu);
$smarty->assign("Accion", $accion);


$smarty->assign("self", $self);
$smarty->assign("tabla", $tabla);
$smarty->assign("relacion", $objeto);
$smarty->assign("OBJETO", $OBJETO);
$smarty->assign("SUBOBJETO", $SUBOBJETO);

?>
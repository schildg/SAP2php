<?php
$smarty  = new Smarty();
include_once ("Clases/Persona.php");
include_once ("Clases/Tabla.php");
include_once ("Clases/Venta_CRM_TODO.php");

$tabla = new Tabla();

$smarty->assign("self", $self);
if(isset($_POST['fecha_1'])){
	$fecha_1=strtodate($_POST['fecha_1']);
	$fecha_2=strtodate($_POST['fecha_2']);
	$sociedad=$_POST['sociedad'];
	$org_vta=$_POST['org_vta'];
}else{
	if(isset($_GET['fecha_1'])){
		$fecha_1=($_GET['fecha_1']);
		$fecha_2=($_GET['fecha_2']);
		$sociedad=$_GET['sociedad'];
		$org_vta=$_GET['org_vta'];
	}else{
		if(isset($_SESSION['rpt_vta_fecha_1'])&&isset($_SESSION['rpt_vta_fecha_2'])){
			$fecha_1=$_SESSION['rpt_vta_fecha_1'];
			$fecha_2=$_SESSION['rpt_vta_fecha_2'];
			$sociedad=$_SESSION['rpt_vta_sociedad'];
			$org_vta=$_SESSION['rpt_vta_org_vta'];
		} else{
			$fecha_1=date('Y-m-d',time()-(15*24*60*60));
			$fecha_2=date('Y-m-d',time()+(15*24*60*60));
			$sociedad='%%';
			$org_vta='%%';
			
		}
	}
};

$_SESSION['rpt_vta_fecha_1']=$fecha_1;
$_SESSION['rpt_vta_fecha_2']=$fecha_2;
$_SESSION['rpt_vta_sociedad']=$sociedad;
$_SESSION['rpt_vta_org_vta']=$org_vta;

if(!isset($_SESSION['rpt_vta_sociedad_lst'])){
	$sql_ok = true; 
	$sql = "select BUKRS from venta_crm_todo group by bukrs";
	try {
		$sociedades = MyActiveRecord :: QueryViews($sql);
	} catch (Exception $e) {
		echo $e;
		$sql_ok = false;
	}
	
	$sql_ok = true; 
	$_SESSION['rpt_vta_sociedad_lst']=$sociedades;
}else{
	$sociedades=$_SESSION['rpt_vta_sociedad_lst'];
	
}

if(!isset($_SESSION['rpt_vta_org_vta_lst'])){
	$sql_ok = true; 
	$sql = "select VKORG from venta_crm_todo group by VKORG";
	try {
		$org_ventas = MyActiveRecord :: QueryViews($sql);
	} catch (Exception $e) {
		echo $e;
		$sql_ok = false;
	}
	$_SESSION['rpt_vta_org_vta_lst']=$org_ventas;
}else{
	$org_ventas=$_SESSION['rpt_vta_org_vta_lst'];
}



if($accion=="generarRptVentas"){
	if(isset($_GET['campoorden'])){
		$orden_sql=" ORDER BY ".$_GET['campoorden']." ".$_GET['orden'];
	}
	$sql_ok = true; 
	$sql = "select v.bukrs,v.vkorg,v.perio,v.kunnr,c.name1,v.kunn2,d.name1 as name2,c.kunn2 as vcart,a.name1 as name3,v.matnr,m.maktg,sum(zmeng) as kilos,sum(netpr_usd) as impo, sum(wavwr_usd) as costo,sum(netpr_usd) - sum(wavwr_usd) as renta 
	from venta_crm_todo as v 
	left join cliente_crm_todo as c on c.bukrs=v.bukrs and c.kunnr=v.kunnr and c.vkorg=v.vkorg 
	left join cliente_crm_todo as d on d.bukrs=v.bukrs and d.kunnr=v.kunn2 and d.vkorg=v.vkorg 
	left join cliente_crm_todo as a on a.bukrs=v.bukrs and a.kunnr=c.kunn2 and a.vkorg=v.vkorg 
	left join material as m on v.matnr=m.matnr 
	where erdat between '".str_replace("-","",$fecha_1)."' and '".str_replace("-","",$fecha_2)."' and v.bukrs like '".$sociedad."'  and v.vkorg like '%".$org_vta."%'  group by v.bukrs,v.vkorg,v.perio,v.kunnr,v.kunn2,v.matnr";
	try {
		$consulta = MyActiveRecord :: QueryViews($sql.$orden_sql);
	} catch (Exception $e) {
		echo $e;
		$sql_ok = false;
	}
	
	$sql_ok = true; 
	
}

$smarty->assign("self", $self);

$smarty->assign("fecha_1", $fecha_1);
$smarty->assign("fecha_2", $fecha_2);
$smarty->assign("consulta", $consulta);
$smarty->assign("tabla", $tabla);
$smarty->assign("exportarPlanCal", $exportarPlanCal);
$smarty->assign("sociedad", $sociedad);
$smarty->assign("org_vta", $org_vta);
$smarty->assign("org_ventas", $org_ventas);
$smarty->assign("sociedades", $sociedades);




$smarty->display('rpt_Venta.tpl');

?>




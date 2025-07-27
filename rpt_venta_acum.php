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
	$vendedor=$_POST['vendedor'];
	$sociedad=$_POST['sociedad'];
	$org_vta=$_POST['org_vta'];
	$clasf=$_POST['clasf'];
}else{
	if(isset($_GET['fecha_1'])){
		$fecha_1=($_GET['fecha_1']);
		$fecha_2=($_GET['fecha_2']);
		$vendedor=$_GET['vendedor'];
		$sociedad=$_GET['sociedad'];
		$org_vta=$_GET['org_vta'];
		$clasf=$_GET['clasf'];
	}else{
		if(isset($_SESSION['rpt_vta_acum_fecha_1'])&&isset($_SESSION['rpt_vta_acum_fecha_2'])){
			$fecha_1=$_SESSION['rpt_vta_acum_fecha_1'];
			$fecha_2=$_SESSION['rpt_vta_acum_fecha_2'];
			$vendedor=$_SESSION['rpt_vta_acum_vendedor'];
			$sociedad=$_SESSION['rpt_vta_acum_sociedad'];
			$org_vta=$_SESSION['rpt_vta_acum_org_vta'];
			$clasf=$_SESSION['rpt_vta_acum_clasf'];
		} else{
			$fecha_1=date('Y-m-d',time()-(90*24*60*60));
			$fecha_2=date('Y-m-d',time());
			$vendedor='%%';
			$sociedad='%%';
			$org_vta='%%';
			$clasf='Historico';
		}
	}
};



$_SESSION['rpt_vta_acum_fecha_1']=$fecha_1;
$_SESSION['rpt_vta_acum_fecha_2']=$fecha_2;
$_SESSION['rpt_vta_acum_vendedor']=$vendedor;
$_SESSION['rpt_vta_acum_sociedad']=$sociedad;
$_SESSION['rpt_vta_acum_org_vta']=$org_vta;
$_SESSION['rpt_vta_acum_clasf']=$clasf;





if(!isset($_SESSION['rpt_vta_acum_vendedor_lst'])){
	$sql_ok = true; 
	$sql = "select v.bukrs,v.kunn2 AS KUNNR,if(c.name1 is null,'Sin Definir',c.name1) AS NAME1 from `venta_crm_todo` as v left join cliente_crm_todo as c on v.kunn2=c.kunnr group by v.kunn2 ORDER BY v.bukrs,NAME1 ASC";
	try {
		$vendedores = MyActiveRecord :: QueryViews($sql);
	} catch (Exception $e) {
		echo $e;
		$sql_ok = false;
	}
	$_SESSION['rpt_vta_acum_vendedor_lst']=$vendedores;
}else{
	$vendedores=$_SESSION['rpt_vta_acum_vendedor_lst'];	
}



if(!isset($_SESSION['rpt_vta_acum_sociedad_lst'])){
	$sql_ok = true; 
	$sql = "select BUKRS from venta_crm_todo group by bukrs";
	try {
		$sociedades = MyActiveRecord :: QueryViews($sql);
	} catch (Exception $e) {
		echo $e;
		$sql_ok = false;
	}
	
	$sql_ok = true; 
	$_SESSION['rpt_vta_acum_sociedad_lst']=$sociedades;
}else{
	$sociedades=$_SESSION['rpt_vta_acum_sociedad_lst'];
	
}

if(!isset($_SESSION['rpt_vta_acum_org_vta_lst'])){
	$sql_ok = true; 
	$sql = "select VKORG from venta_crm_todo group by VKORG";
	try {
		$org_ventas = MyActiveRecord :: QueryViews($sql);
	} catch (Exception $e) {
		echo $e;
		$sql_ok = false;
	}
	$_SESSION['rpt_vta_acum_org_vta_lst']=$org_ventas;
}else{
	$org_ventas=$_SESSION['rpt_vta_acum_org_vta_lst'];
}


if($accion=="generarRptVentasAcum"){
	if(isset($_GET['campoorden'])){
		$orden_sql=" ORDER BY ".$_GET['campoorden']." ".$_GET['orden'];
	}
	$sql_ok = true; 
	$fecha_2_per = date('Y-m-d',mktime(0,0,0,date('m',strtotime($fecha_1)),date('d',strtotime($fecha_1)),date('Y',strtotime($fecha_1)))-1*60*60*24);
	$fecha_1_per = date('Y-m-d',mktime(0,0,0,date('m',strtotime($fecha_1)),date('d',strtotime($fecha_1)),date('Y',strtotime($fecha_1)))-365*60*60*24);
	
	$periodo=array();
	for($i=$fecha_1;$i<=$fecha_2;$i = date("Y-m-d", strtotime($i ."+ 1 month"))){
	    $periodo[]= date('Ym',strtotime($i));
	}
	
	$s1='';$s2='';$s3='';
	foreach ($periodo as $p){
		$s1=$s1.",sum(h.$p) as '$p'";
		$s2=$s2.",if(v.perio='$p',sum(netpr_usd-wavwr_usd),0) as '$p'";
		if($s3==''){$s3='h.'.$p;}else{$s3=$s3.'+ h.'.$p;};
	}
	
	if($clasf=='Historico'){
	$sql="select h.bukrs,h.vkorg,h.kunnr,h.name1,h.kunn2,h.name2 as name2,h.matnr,h.maktg$s1,@total:=sum($s3) as total,@vta_cli:=if(n1.venta_cliente is null,0,n1.venta_cliente) as venta_cliente,@vta_pro:=if(n2.venta_material is null,0,n2.venta_material) as venta_material,if(@vta_cli=0,'Cliente Nuevo',if(@vta_pro=0,'Producto Nuevo','Cliente y Producto Existente')) as Clasificacion
	 from (select v.bukrs,v.vkorg,v.kunnr,c.name1,v.kunn2,d.name1 as name2,v.matnr,m.maktg$s2
			from venta_crm_todo as v 
			left join cliente_crm_todo as c on c.bukrs=v.bukrs and c.kunnr=v.kunnr and c.vkorg=v.vkorg 
			left join cliente_crm_todo as d on d.bukrs=v.bukrs and d.kunnr=v.kunn2 and d.vkorg=v.vkorg 
			left join material as m on v.matnr=m.matnr 
			
			where erdat between  '".str_replace("-","",$fecha_1)."' and '".str_replace("-","",$fecha_2)."' and v.bukrs like '".$sociedad."'  and v.vkorg like '%".$org_vta."%'  and v.kunn2 like '%".$vendedor."%'  group by v.bukrs,v.kunnr,v.matnr,v.perio,v.vkorg,v.kunn2) as h left join 
	   
	   (select v.bukrs,v.kunnr,sum(netpr_usd) as venta_cliente
			from venta_crm_todo as v 
			where erdat between  '".str_replace("-","",$fecha_1_per)."' and '".str_replace("-","",$fecha_2_per)."' and v.bukrs like '".$sociedad."' group by v.bukrs,v.kunnr) as n1 on
	        n1.bukrs=h.bukrs and n1.kunnr=h.kunnr left join
	        (select v.bukrs,v.kunnr,v.matnr,sum(netpr_usd) as venta_material
			from venta_crm_todo as v 
			where erdat between  '".str_replace("-","",$fecha_1_per)."' and '".str_replace("-","",$fecha_2_per)."' and v.bukrs like '".$sociedad."' group by v.bukrs,v.kunnr,v.matnr) as n2 on h.bukrs=n2.bukrs and h.kunnr=n2.kunnr and h.matnr=n2.matnr
	        
	        group by h.bukrs,h.kunnr,h.matnr,h.kunn2";
	}else{
	$sql="select h.bukrs,h.vkorg,h.kunnr,h.name1,h.kunn2,h.name2 as name2,h.matnr,h.maktg$s1,@total:=sum($s3) as total,@vta_cli:=if(n1.venta_cliente is null,0,n1.venta_cliente) as venta_cliente,@vta_pro:=if(n2.venta_material is null,0,n2.venta_material) as venta_material,if(@vta_cli=0,'Cliente Nuevo',if(@vta_pro=0,'Producto Nuevo','Cliente y Producto Existente')) as Clasificacion
	 from (select v.bukrs,v.vkorg,v.kunnr,c.name1,c.kunn2,a.name1 as name2,v.matnr,m.maktg$s2
			from venta_crm_todo as v 
			left join cliente_crm_todo as c on c.bukrs=v.bukrs and c.kunnr=v.kunnr and c.vkorg=v.vkorg 
			left join cliente_crm_todo as a on a.bukrs=v.bukrs and a.kunnr=c.kunn2 and a.vkorg=v.vkorg 
			left join material as m on v.matnr=m.matnr 
			
			where erdat between  '".str_replace("-","",$fecha_1)."' and '".str_replace("-","",$fecha_2)."' and v.bukrs like '".$sociedad."'  and v.vkorg like '%".$org_vta."%'  and c.kunn2 like '%".$vendedor."%'  group by v.bukrs,v.kunnr,v.matnr,v.perio,v.vkorg,c.kunn2) as h left join 
	   
	   (select v.bukrs,v.kunnr,sum(netpr_usd) as venta_cliente
			from venta_crm_todo as v 
			where erdat between  '".str_replace("-","",$fecha_1_per)."' and '".str_replace("-","",$fecha_2_per)."' and v.bukrs like '".$sociedad."' group by v.bukrs,v.kunnr) as n1 on
	        n1.bukrs=h.bukrs and n1.kunnr=h.kunnr left join
	        (select v.bukrs,v.kunnr,v.matnr,sum(netpr_usd) as venta_material
			from venta_crm_todo as v 
			where erdat between  '".str_replace("-","",$fecha_1_per)."' and '".str_replace("-","",$fecha_2_per)."' and v.bukrs like '".$sociedad."' group by v.bukrs,v.kunnr,v.matnr) as n2 on h.bukrs=n2.bukrs and h.kunnr=n2.kunnr and h.matnr=n2.matnr
	        
	        group by h.bukrs,h.kunnr,h.matnr,h.kunn2";
		
	}
//	echo $sql;
	try {
		$consulta = MyActiveRecord :: QueryViews($sql.$orden_sql);
	} catch (Exception $e) {
		echo $e;
		$sql_ok = false;
	}
	
	$sql_ok = true; 
	
}
$clasificacion[0]='Historico';
$clasificacion[1]='Cartera';

$smarty->assign("self", $self);

$smarty->assign("fecha_1", $fecha_1);
$smarty->assign("fecha_2", $fecha_2);
$smarty->assign("vendedor", $vendedor);
$smarty->assign("sociedad", $sociedad);
$smarty->assign("org_vta", $org_vta);
$smarty->assign("vendedores", $vendedores);
$smarty->assign("org_ventas", $org_ventas);
$smarty->assign("sociedades", $sociedades);
$smarty->assign("clasificacion", $clasificacion);
$smarty->assign("clasf", $clasf);
$smarty->assign("consulta", $consulta);
$smarty->assign("periodo", $periodo);
$smarty->assign("tabla", $tabla);
$smarty->assign("exportarPlanCal", $exportarPlanCal);

$smarty->display('rpt_Venta_Acum.tpl');

?>




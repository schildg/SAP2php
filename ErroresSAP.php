<?php
$smarty  = new Smarty();
include_once ("Clases/Persona.php");
include_once ("Clases/Tabla.php");
include_once ("Clases/Sl_Tar.php");
include_once ("Clases/St_Doc.php");
include_once ("Clases/Pendiente_Tratar.php");
include_once ("Clases/Resultado_Ejecucion.php");
include_once ("Clases/Out_OrdFab_Consumo.php");

$tabla = new Tabla();

$smarty->assign("self", $self);
if(isset($_POST['fecha_1'])){
	$fecha_1=strtodate($_POST['fecha_1']);
	$fecha_2=strtodate($_POST['fecha_2']);
}else{
	if(isset($_GET['fecha_1'])){
		$fecha_1=($_GET['fecha_1']);
		$fecha_2=($_GET['fecha_2']);
	}else{
		if(isset($_SESSION['fecha_1'])&&isset($_SESSION['fecha_2'])){
			$fecha_1=$_SESSION['fecha_1'];
			$fecha_2=$_SESSION['fecha_2'];
		} else{
			$fecha_1=date('Y-m-d',time()-(15*24*60*60));
			$fecha_2=date('Y-m-d',time()+(15*24*60*60));
		}
	}
};

$_SESSION['fecha_1']=$fecha_1;
$_SESSION['fecha_2']=$fecha_2;

if($accion=="generarReporteErrores"){
	if(isset($_GET['SubAction'])){
		$SubAction=$_GET['SubAction'];
		$id_tarea=$_GET['id_tarea'];
		$id_of_sap=$_GET['id_of_sap'];
		$pen_tra=new Pendiente_Tratar();
		$pen_tra=$pen_tra->FindFirst("Pendiente_Tratar","numero_sap=$id_of_sap");
		$tarea=new Sl_Tar();
		$tarea=$tarea->FindFirst("Sl_Tar","nmov_lt=$id_tarea");
		switch ($SubAction) {
			case "AParticionar":			;
				$pen_tra->estado="PAR";
				$pen_tra->particion=false;
				$pen_tra->save();
				$tarea->declarado_en_sap="";
				$tarea->save();
			break;
			case "PasarParticionar":			;
				$pen_tra->estado="PAR";
				$pen_tra->particion=false;
				$pen_tra->consumo=false;
				$pen_tra->save();
				$tarea->declarado_en_sap="";
				$tarea->save();
			break;
			case "AConsumir":
				$pen_tra->estado="CSM";
				$pen_tra->consumo=false;
				$pen_tra->save();
				$tarea->declarado_en_sap="Particionada";
				$tarea->save();
			break;
			
		}
	};
	
	if(isset($_GET['campoorden'])){
		$orden_sql=" ORDER BY ".$_GET['campoorden']." ".$_GET['orden'];
	}
	$sql_ok = true; 
	$sql = "(SELECT declarado_en_sap,nmov_lt,utor_lt,cant_lt,estado,codigo,numero,fech_sd,numero_sap,id_objeto_sap,rfc,type,number,message,matnr,charg,exidv_ob FROM sl_tar,st_doc,pendiente_tratar,resultado_ejecucion as r,out_ordfab_consumo as o where rfc like '%CONSUM%' and type='E' and (id_objeto_sap like '%-2' or (id_objeto_sap like '%-1' and r.tarea not in (SELECT tarea FROM resultado_ejecucion where rfc like '%CONSUM%' and id_objeto_sap like '%-2' and type='E'))) and cmov_sd='HF' and fech_sd>='$fecha_1' and fech_sd<='$fecha_2' and cmov_sd=cdoc_lt and nmov_sd=ndoc_lt and cdoc_sd=codigo and ndoc_sd=numero and tipo_lt<>1 and estado<>'OKs' and declarado_en_sap<>'Notificada' and nmov_lt=r.tarea and r.tarea=o.tarea) UNION(
			SELECT declarado_en_sap,nmov_lt,utor_lt,cant_lt,estado,codigo,numero,fech_sd,numero_sap,id_objeto_sap,rfc,type,number,message,matnr,charg,exidv_ob FROM sl_tar,st_doc,pendiente_tratar,resultado_ejecucion as r,out_ordfab_consumo as o WHERE cmov_sd='HF' and fech_sd>='$fecha_1' and fech_sd<='$fecha_2' and cmov_sd=cdoc_lt and nmov_sd=ndoc_lt and cdoc_sd=codigo and ndoc_sd=numero and tipo_lt<>1 and estado<>'OKs' and declarado_en_sap<>'Notificada'  and o.tarea=r.tarea and nmov_lt=r.tarea AND RFC like '%PARTI%' AND not((TYPE='E' AND NUMBER=103)OR(TYPE='I' AND NUMBER=133)OR(TYPE='I' AND NUMBER=131)))";
	try {
		$consulta = MyActiveRecord :: QueryViews($sql.$orden_sql);
	} catch (Exception $e) {
		echo $e;
		$sql_ok = false;
	}
	
	$sql_ok = true; 
	$sql = "SELECT estado,count(*) as cuenta from pendiente_tratar group by estado";
	try {
		$estado = MyActiveRecord :: QueryViews($sql);
	} catch (Exception $e) {
		echo $e;
		$sql_ok = false;
	}
	
}

$smarty->assign("self", $self);

$smarty->assign("fecha_1", $fecha_1);
$smarty->assign("fecha_2", $fecha_2);
$smarty->assign("consulta", $consulta);
$smarty->assign("estado", $estado);
$smarty->assign("tabla", $tabla);
$smarty->assign("exportarPlanCal", $exportarPlanCal);

$smarty->display('ErroresSAP.tpl');

?>




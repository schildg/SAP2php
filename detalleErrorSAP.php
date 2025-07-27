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
if(isset($_POST['id_tarea'])){
	$id_tarea=strtodate($_POST['id_tarea']);
}else{
	$id_tarea=($_GET['id_tarea']);
};


	$sql_ok = true; 
	$sql = "SELECT estado,codigo,numero,numero_sap,id_objeto_sap,rfc,type,number,message,AUFNR,RSPOS,MATNR,WERKS,CHARG,LGORT,SOBKZ,VORNR,MENGE,MEINS,ERFMG,ERFME,VHILM,EXBNR,EXIDV,EXIDV_OB,EXPLZ,ERNAM,ERDAT,ERZET,TWFLG,BERTS FROM pendiente_tratar,resultado_ejecucion as r,out_ordfab_consumo as o where  r.tarea=$id_tarea and o.tarea=r.tarea and aufnr=concat('00000',numero_sap)";	
	try {
		$consulta = MyActiveRecord :: QueryViews($sql);
	} catch (Exception $e) {
		echo $e;
		$sql_ok = false;
	}
	

$smarty->assign("self", $self);


$smarty->assign("consulta", $consulta);
$smarty->assign("tabla", $tabla);

$smarty->display('detalleErrorSAP.tpl');












?>




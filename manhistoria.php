<?php
include_once ("Clases/DATA_CONF.php");
$smarty = new Smarty();
$self = $_SERVER['PHP_SELF'];
include_once ("Clases/Tabla.php");
include_once ("Clases/Attach.php");
$OBJETO = $_GET["objeto"];
include_once ("Clases/$OBJETO.php");
$tabla = new Tabla();
$attach = new Attach();
$colu= MyActiveRecord::Columns($OBJETO);
$relacion= MyActiveRecord::Create($OBJETO);
$objeto= MyActiveRecord::Create($OBJETO);

$smarty->assign("self", $self);
$smarty->assign("attach", $attach);
$smarty->assign("tabla", $tabla);
$smarty->assign("relacion", $relacion);
$smarty->assign("objeto", $objeto);
$smarty->assign("OBJETO", $OBJETO);

//if ($verHistoria == 1){
	include_once ("Clases/Historia.php");
	$historia = new Historia();
	$listaHistoria=$historia->buscarHistoria($OBJETO,$_GET["id"]);
	$smarty->assign("listaHistoria", $listaHistoria);
//}
			$smarty->display('historia.tpl');

?>
<?php
include_once ("Clases/ListaMovimientoMateriales.php");
$listamovimientomateriales = new ListaMovimientoMateriales();

$OBJETO='ListaMovimientoMateriales';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MAT_DOC','DOC_YEAR','TR_EV_TYPE','PSTNG_DATE',);

include_once ("datos-listador.php");

$smarty->assign("objeto", $listamovimientomateriales);

$aListaMovimientoMaterialess = $listamovimientomateriales->FindAll($OBJETO,'',$ORDEN);

$smarty->assign("listaObjetos", $aListaMovimientoMaterialess);

$smarty->assign("titulo", "Listado del ListaMovimientoMateriales");

$smarty->display('cabeceraListado.tpl');

$smarty->display('ListadorDeDatos.tpl');
?>
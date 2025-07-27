<?php
include_once ("Clases/ListaMovimientoMateriales.php");
$smarty = new Smarty();
$listamovimientomateriales = new ListaMovimientoMateriales();
$OBJETO = 'ListaMovimientoMateriales';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','MAT_DOC','DOC_YEAR','TR_EV_TYPE','PSTNG_DATE','REF_DOC_NO','EXIDV','VENUM','VBELN','POSNR','UNVEL','VEMNG','VEMEH','MATNR','CHARG','WERKS','LGORT','WDATU','VFDAT','HU_LGORT','XCHAR',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del listamovimientomateriales");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aListaMovimientoMaterialess = $listamovimientomateriales->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aListaMovimientoMaterialess);

$smarty->display('ListadorDeDatos.tpl');
?>
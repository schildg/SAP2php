<?php
include_once ("Clases/Centro.php");
$smarty = new Smarty();
$centro = new Centro();
$OBJETO = 'Centro';
$SUBOBJETO=$OBJETO;
$CAMPOS = array('id','WERKS','NAME1','BWKEY','KUNNR','LIFNR','FABKL','NAME2','STRAS','PFACH','PSTLZ','ORT01','EKORG','VKORG','CHAZV','KKOWK','KORDB','BEDPL','LAND1','REGIO','COUNC','CITYC','ADRNR','IWERK','TXJCD','VTWEG','SPART','SPRAS','WKSOP','AWSLS','CHAZV_OLD','VLFKZ','BZIRK','ZONE1','TAXIW','BZQHL','LET01','LET02','LET03','TXNAM_MA1','TXNAM_MA2','TXNAM_MA3','BETOL','J_1BBRANCH','VTBFI','FPRFW','ACHVM','DVSART','NODETYPE','NSCHEMA','PKOSA','MISCH','MGVUPD','VSTEL','MGVLAUPD','MGVLAREVAL','SOURCING','OILIVAL','OIHVTYPE','OIHCREDIPI','STORETYPE','DEP_STORE',);

include_once ("datos-filtro.php");

$smarty->assign("titulo", "Filtro de los datos del centro");

$smarty->display('cabeceraListado.tpl');

$smarty->display('FiltradorDeDatos.tpl');

include_once ("datos-filtro-listador.php");

$aCentros = $centro->FindAll($OBJETO,$QUERY_FILTRO,$ORDEN);
$smarty->assign("listaObjetos", $aCentros);

$smarty->display('ListadorDeDatos.tpl');
?>
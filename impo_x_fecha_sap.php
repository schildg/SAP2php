<?php
include_once('Clases/Servicio.php');
$serv = New Servicio("impo_x_fecha_sap");

if($serv->bloqueado){
	$serv->stop();
	if (!$serv->is_running()){exit;}		
}


include_once ("Clases/Almacen.php");
include_once ("Clases/Centro.php");
include_once ("Clases/Existencia_Material.php");
include_once ("Clases/Material.php");
include_once ("Clases/Cliente_CRM_TODO.php");
include_once ("Clases/Cheques.php");
include_once ("Clases/Condicion_Pago.php");
include_once ("Clases/Deuda_CRM_TODO.php");
include_once ("Clases/Recibo_CRM.php");
include_once ("Clases/Actualizacion_CRM.php");
include_once ("Clases/Estruc_TrasabCob.php");
include_once ("Clases/Venta_CRM_TODO.php");
include_once ("Clases/Venta_CRM_TMP.php");
include_once ("Clases/Deuda_CRM.php");
include_once ("Clases/Deuda_CRM_TMP.php");
include_once ("Clases/Cobranza_CRM_TMP.php");
include_once ("Clases/Stock_CRM.php");
include_once ("Clases/Stock_CRM_tmp.php");
include_once ("Clases/PPendientes_CRM_TODO.php");
include_once ("Clases/saprfc.php");
include_once ("funciones.php");
$tiempo_en_seg = 2;//60*0.5;

$vuelta=0;

while ($serv->is_running()){
    		
	$serv->set_subestado("llamando funcion");
	$login = array (
			"ASHOST"=>SAPRFC_ASHOST,
			"SYSNR"=>SAPRFC_SYSNR,
			"CLIENT"=>SAPRFC_CLIENT,
			"USER"=>SAPRFC_USER,
			"PASSWD"=>SAPRFC_PASSWD,
			"CODEPAGE"=>SAPRFC_CODEPAGE
	        );
	$rfc = saprfc_open ($login );
	if (!$rfc ) { $serv->pongo_hayError("RFC connection failed"); exit; }
	
	$reg_ult_act = new Actualizacion_CRM("Fecha_Compensacion");
	$str_fecha=$reg_ult_act->Ultima_Actualizacion;
	
	$str_anio=substr($str_fecha,0,4);
	$str_mes=substr($str_fecha,4,2);
	$str_dia=substr($str_fecha,6,2);
	$str_fecha=$str_anio.$str_mes.$str_dia;
	$timestamp = mktime(0, 0, 0,  $str_mes,$str_dia,$str_anio)+ ( 1 * 60 * 60 * 24);
	$fecha_inicio = date("Ymd",$timestamp);
	$ultimo=getUltimoDiaMes(date("Y",$timestamp), date("m",$timestamp));
	$timestamp = mktime(0, 0, 0,date("m",$timestamp),$ultimo,date("Y",$timestamp)); 
	$fecha_fin = date("Ymd",$timestamp);
	$per=date("Ym",$timestamp);
	$serv->set_subestado("fecha $fecha_inicio  >>   $fecha_fin");
	echo "fecha inicio:".$fecha_inicio." fecha fin:".$fecha_fin."  Fech BD:".$reg_ult_act->Ultima_Actualizacion."\r\n";
	
	$timestamp = mktime(0, 0, 0,  date("m"), date("d"), date("Y"));
	$fecha_HOY = date("Ymd",$timestamp);
	
/*	$SQL_INSERT="insert into venta_crm_todo (CRM_ID,KUNNR,MATNR,KUNN2,VKORG,UNNEG,WAERK,ZTERM,BSARK,AUART,WERKS,LGORT,PRCTR,VKGRP,VKBUR,XBLNR,VBELN,POSNR,ERDAT,PU_ML,
PU_USD,NETPR,NETPR_USD,CU_ML,CU_USD,WAVWR,WAVWR_USD,ZMENG,ZIEME,STCUR,BSTNK,MEINS,VRKME,HB_EXPDATE,BUKRS,FKART,KKBER,DOCFI,GJAHR,BLART,SHKZG,ZFBDT,PERIO) 
select CRM_ID,KUNNR,MATNR,KUNN2,VKORG,UNNEG,WAERK,ZTERM,BSARK,AUART,WERKS,LGORT,PRCTR,VKGRP,VKBUR,XBLNR,VBELN,POSNR,ERDAT,PU_ML,
PU_USD,NETPR,NETPR_USD,CU_ML,CU_USD,WAVWR,WAVWR_USD,ZMENG,ZIEME,STCUR,BSTNK,MEINS,VRKME,HB_EXPDATE,BUKRS,FKART,KKBER,DOCFI,GJAHR,BLART,SHKZG,ZFBDT,PERIO
from venta_anita where perio='".$per."'";
*/	
	
/*	$SQL_INSERT="
	
	

INSERT INTO venta_anita 
(CRM_ID,KUNNR,MATNR,VKORG,KUNN2,UNNEG,WAERK,ZTERM,BSARK,AUART,WERKS,LGORT,PRCTR,VKGRP,VKBUR,XBLNR,VBELN,POSNR,ERDAT,PU_ML,PU_USD,NETPR,NETPR_USD,CU_ML,CU_USD,WAVWR,
WAVWR_USD,ZMENG,ZIEME,STCUR,BSTNK,MEINS,VRKME,HB_EXPDATE,BUKRS,FKART,KKBER,DOCFI,GJAHR,BLART,SHKZG,ZFBDT,PERIO)



SELECT 
CL.CRM_ID_REAL AS CRM_ID,
SUBSTRING(CL.CRM_ID_REAL,1,10) AS KUNNR,
TA.MATNR AS MATNR,
CL.SUN AS VKORG,
VI.KUNN2 AS KUNN2,
IF(CL.sUN='2010','Feed',IF(CL.sUN='2020','Food','Industrial')) as UNNEG,
if(mone_vd is null,IF(st.MONE_SD=1,'ARS','USD'),IF(C.MONE_VD=1,'ARS','USD')) AS WAERK,
PG.ZTERM AS ZTERM,
'' AS BSARK,
IF(SUBSTRING(CDOC_BH,1,1)='F','ZPE2',IF(SUBSTRING(CDOC_BH,1,1)='C','ZNC1','ZND1')) AS AUART,
if(ubic_vs='URU' OR ubic_vs='PRX','2004','2001') as WERKS,
if(ubic_vs='URU' OR ubic_vs='PRX','AC01','ACFE') as LGORT,
IF(CL.sUN='2010','2021019901',IF(CL.sUN='2020','2022029901','2023039901')) AS PRCTR,
IF(CL.sUN='2010','100',IF(CL.sUN='2020','120','155')) AS VKGRP,
IF(CL.sUN='2010','2004','2001') AS VKBUR,
if(c.xblnr is null,'',c.xblnr) as XBLNR,
concat(cdoc_bh,ndoc_bh) as VBELN,
RPAD(item_bh,2,'0') AS POSNR,
REPLACE(fech_bh,'-','') as ERDAT,
(PRED_BH*(if (DOLA_VD is null,st.dola_sd,dola_vd))) as PU_ML,
PRED_BH as PU_USD,
SUM(if (DOLA_VD is null,st.dola_sd,dola_vd)*PRED_BH*CANT_BH) as NETPR,
SUM(PRED_BH*CANT_BH) as NETPR_USD,

(CSCF_BH*if (DOLA_VD is null,st.dola_sd,dola_vd)) as CU_ML,
CSCF_BH as CU_USD,
sum(if (DOLA_VD is null,st.dola_sd,dola_vd)*CSCF_BH*CANT_BH) as WAVWR,
sum(CSCF_BH*CANT_BH) as WAVWR_USD,

sum(CANV_BH) AS ZMENG,
'' AS ZIEME,
if(DOLA_VD is null,st.dola_sd,dola_vd) AS STCUR,
if(cmov_vd is null,CONCAT(st.CDOC_sD,st.NDOC_sD),CONCAT(CDOC_VD,NDOC_VD)) AS BSTNK,
m.MEINS AS MEINS,
'' AS VRKME,
REPLACE(fven_vd001,'-','') AS HB_EXPDATE,
'AR20' AS BUKRS,
IF(SUBSTRING(cdoc_bh,1,1)='F','ZFE2','') as FKART,
IF(CL.sUN='2010','ACFE',IF(CL.sUN='2020','ACFO','ACIN')) as KKBER,
concat(cdoc_bh,ndoc_bh) as DOCFI,
SUBSTRING(FECH_bh,1,4) AS GJAHR,
IF(SUBSTRING(cdoc_bh,1,1)='F','DR',IF(SUBSTRING(cdoc_bh,1,1)='D','DA','DG')) AS BLART,
IF(SUBSTRING(cdoc_bh,1,1)='C','H','S') AS SHKZG,
REPLACE(fech_bh,'-','') as ZFBDT,
SUBSTRING(REPLACE(fech_bh,'-',''),1,6) as PERIO

FROM ve_cos as co 
left join ve_doc as c on co.cdoc_bh=c.cmov_vd and co.ndoc_bh=c.nmov_vd
left join st_doc as sh on co.cdoc_bh=sh.cmov_sd and co.ndoc_bh=sh.nmov_sd
left join st_doc as st on st.cmov_sd=sh.cdoc_sd and st.nmov_sd=sh.ndoc_sd
left join ve_lar as l on l.cmov_gc=co.cdoc_bh and l.nmov_gc=co.ndoc_bh and site_gc=co.item_bh
left join st_lar as sl on sl.cmov_gd=co.cdoc_bh and sl.nmov_gd=co.ndoc_bh and sl.site_gd=co.item_bh
left join temp_cli_crm as cl on cl.firm_vd=if(c.firm_vd is null,st.firm_sd,c.firm_vd) and cl.clie_vd=if(c.clie_vd is null,st.clie_sd,c.clie_vd)
left join temp_art_mat as ta on ta.prod_sa=co.prod_bh and ta.marc_sa=co.marc_bh and ta.enva_sa=co.enva_bh and ta.cenv_sa=co.cenv_bh and ta.un=if(st.firm_sd is null,if(c.firm_vd='011','FE',if(c.firm_vd='009','IN',if(c.firm_vd='008','PH',if(c.firm_vd='003','IN','FO')))),if(st.firm_sd='011','FE',if(st.firm_sd='009','IN',if(st.firm_sd='008','PH',if(st.firm_sd='003','IN','FO')))))
left join material as m on m.matnr=ta.matnr
left join temp_vend as vi on vi.viaj_vd=if(c.viaj_vd is null,st.viaj_sd,c.viaj_vd)
left join temp_pago as pg on pg.copa_vd=if(c.copa_vd is null,'CONT',c.copa_vd)
left join va_ser as s on arch_vs=if(c.cmov_vd is null,'st-doc','ve-doc') and cmov_vs=if(c.cmov_vd is null,st.cmov_sd,c.cmov_vd) and if(c.cmov_vd is null,st.nmov_sd between desd_vs and hast_vs,c.nmov_vd between desd_vs and hast_vs)
where fech_bh between '".$fecha_inicio."' and '".$fecha_fin."' and clas_bh='001' 
group by co.cdoc_bh,co.ndoc_bh,co.item_bh";
	
	
	try { //Actualizamos la venta
		MyActiveRecord :: Query($SQL_INSERT);
	} catch (Exception $e) {
		$serv->pongo_hayError($SQL_INSERT."||".$e);
		$sql_ok = false;
	}
	
	
*/	
	
	
	
//	$serv->stop();

//	include("impo_venta2_crm.php");
	$fecha_ini_cobranza=$fecha_inicio;
	$fecha_fin_cobranza=$fecha_fin;
	include("impo_cobranza5.php");
//	include("TRASABCOB.php");
//	include("impo_ppendiente_crm.php");
//	include("impo_Stock_CRM.php");

	
	$serv->set_subestado("liberando/cerrando conexion");
	saprfc_close($rfc);
	for($i=0;$i<=$tiempo_en_seg;$i++){
		if ($serv->is_running()){
			$serv->set_subestado("el ciclo se inicia en ".(($tiempo_en_seg)-$i)." segundos");
			sleep(1); //espera $tiempo_en_seg minutos
		}else{
			break;
		}
	}
	$reg_ult_act = new Actualizacion_CRM("Fecha_Compensacion");
	$reg_ult_act->Ultima_Actualizacion=$fecha_fin;
	$reg_ult_act->save();
	
	if($fecha_fin>$fecha_HOY){
		$serv->stop();
	}
	
}

?>
<?php
	
/***************************************************************************************************************
 * *************************************************************************************************************
 * *
 * *          ACA EMPIEZA EL TRATAMIENTO DE PENDIENTES
 * *
 * *************************************************************************************************************
 ***************************************************************************************************************/

		
/***************************************************************************************************************
 * *************************************************************************************************************
 * *
 * *          ACA EMPIEZA EL TRATAMIENTO DE RECIBOS COMPENZADOS
 * *
 * *************************************************************************************************************
 ***************************************************************************************************************/

$sql_ok = true; 
$sql = "TRUNCATE TABLE `cobranza_crm_tmp`";       //borro toda la cobranza temporal
try {
	MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$serv->pongo_hayError($sql."||".$e);
	$sql_ok = false;
}

/************************************************************************************
 *     A CONTINUACION SE TRATA COBRANZAS DE ARGENTINA
 * 
 ************************************************************************************/

$periodo_contable   =  date("Y",strtotime($fecha_inicio));
//echo $periodo_contable."\r\n";

	$serv->set_subestado("iniciando proceso ZFI_COBRANZA3(AR20) $fecha_fin_cobranza");
	$fce = saprfc_function_discover($rfc,"ZFI_COBRANZA3");
	if (! $fce ) { $serv->pongo_hayError("Discovering interface of function module failed ZFI_COBRANZA3"); exit; }

	saprfc_import ($fce,"SOCIEDAD","AR20");
	saprfc_import ($fce,"EJERCICIO",$periodo_contable);
	//	saprfc_import ($fce,"FECHA_DESDE",$fecha_inicio);
	saprfc_import ($fce,"FECHA_DESDE",$fecha_ini_cobranza);
	saprfc_import ($fce,"FECHA_HASTA",$fecha_fin_cobranza);
	saprfc_import ($fce,"RUTA","");
	saprfc_import ($fce,"TIPO","");
	//Fill internal tables
	saprfc_table_init ($fce,"ZSFI_COBRANZA");
	//Do RFC call of function ZFI_COBRANZA, for handling exceptions use saprfc_exception()
	$rfc_rc = saprfc_call_and_receive ($fce);
	if ($rfc_rc != SAPRFC_OK) { if ($rfc == SAPRFC_EXCEPTION ) $serv->pongo_hayError("Exception raised: ".saprfc_exception($fce)); else $serv->pongo_hayError(saprfc_error($fce)); exit; }
	$serv->set_subestado("procesando respuesta ZFI_COBRANZA3(AR20)");
	//Retrieve export parameters
	$rows = saprfc_table_rows ($fce,"ZSFI_COBRANZA");

	for ($i=1;$i<=$rows;$i++)
		$ZSFI_COBRANZA[] = saprfc_table_read ($fce,"ZSFI_COBRANZA",$i);
	//Debug info
/*	foreach ($ZSFI_COBRANZA as $cbz) {
		$cobranza = new Cobranza_CRM_TMP();
		foreach ($cbz as $k =>$v){
				$cobranza->$k = $cbz[$k];
			}	
		$cobranza->save();
		if (!$serv->is_running()){exit;}
	}
*/
	cargar_sql_v2($ZSFI_COBRANZA,'Cobranza_CRM_TMP',null,'I',$serv);
	saprfc_function_free($fce);
	unset($cobranza,$ZSFI_COBRANZA,$cbz,$fce,$rfc_rc,$sql,$sql_ok);

/************************************************************************************
 *     A CONTINUACION SE TRATAN SQL
 * 
 ************************************************************************************/
	
	$serv->set_subestado("iniciando proceso ZFI_COBRANZA3(SQL)");
	
If (!$serv->is_running()){exit;}

	$sql = "START TRANSACTION";
	try {
		MyActiveRecord :: Query($sql);
		$sql = "update cobranza_crm_tmp set DIASC=IF(ZFBDT='00000000',0,if(BLART_2='DC' and abs(DATEDIFF(augdt_r,feven_ch))>=30,if(SHKZG='H',DATEDIFF(zfbdt,feven_ch),DATEDIFF(feven_ch,zfbdt)),if(SHKZG='H',DATEDIFF(zfbdt,augdt_r),DATEDIFF(augdt_r,zfbdt))))";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
		
		
		$sql = "update cobranza_crm_tmp set IMPO_POND=DIASC*DMBTR_3";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}		
		
		
		
		
		$sql = "insert IGNORE  into cobranza_crm_todo (BELNR,XBLNR,BUDAT,BLDAT,BUKRS,GJAHR,BLART,WAERS,KUNNR_R,AUGBL_R,AUGDT_R,
					BELNR_3,XBLNR_2,BLART_2,ZTERM,ZFBDT,SHKZG,WAERS_3,CHCKR_CH,FEEMI_CH,FEVEN_CH,BANK_CH,SUCU_CH,WAERS_CH,KKBER_CH,
					WRBTS_3,DMBTR_3,DMBE2_3,WRBTR_CH,DMBE2,DIASC,IMPO_POND) 
				SELECT t.BELNR,
		t.XBLNR,t.BUDAT,t.BLDAT,t.BUKRS,t.GJAHR,t.BLART,t.WAERS,t.KUNNR_R,t.AUGBL_R,t.AUGDT_R,t.BELNR_3,t.XBLNR_2,
		t.BLART_2,t.ZTERM,t.ZFBDT,t.SHKZG,t.WAERS_3,t.CHCKR_CH,t.FEEMI_CH,t.FEVEN_CH,t.BANK_CH,t.SUCU_CH,t.WAERS_CH,
		t.KKBER_CH,sum(t.WRBTS_3) as WRBTS_3,sum(t.DMBTR_3) as DMBTR_3,sum(t.DMBE2_3) as DMBE2_3,sum(t.WRBTR_CH) as WRBTR_CH,
		sum(t.DMBE2) as DMBE2,sum(t.DIASC) as DIASC,sum(t.IMPO_POND) as IMPO_POND
		
		
		 FROM `cobranza_crm_tmp` as t left join `cobranza_crm_todo` as c on 
		t.BELNR=c.BELNR and
		t.XBLNR=c.XBLNR and
		t.BUDAT=c.BUDAT and
		t.BLDAT=c.BLDAT and
		t.BUKRS=c.BUKRS and
		t.GJAHR=c.GJAHR and
		t.BLART=c.BLART and
		t.WAERS=c.WAERS and
		t.KUNNR_R=c.KUNNR_R and
		t.AUGBL_R=c.AUGBL_R and
		t.AUGDT_R=c.AUGDT_R and
		t.BELNR_3=c.BELNR_3 and
		t.XBLNR_2=c.XBLNR_2 and
		t.BLART_2=c.BLART_2 and
		t.ZTERM=c.ZTERM and
		t.ZFBDT=c.ZFBDT and
		t.SHKZG=c.SHKZG and
		t.WAERS_3=c.WAERS_3 and
		t.CHCKR_CH=c.CHCKR_CH and
		t.FEEMI_CH=c.FEEMI_CH and
		t.FEVEN_CH=c.FEVEN_CH and
		t.BANK_CH=c.BANK_CH and
		t.SUCU_CH=c.SUCU_CH and
		t.WAERS_CH=c.WAERS_CH and
		t.KKBER_CH=c.KKBER_CH WHERE c.id is null group by t.BELNR,
		t.XBLNR,
		t.BUDAT,
		t.BLDAT,
		t.BUKRS,
		t.GJAHR,
		t.BLART,
		t.WAERS,
		t.KUNNR_R,
		t.AUGBL_R,
		t.AUGDT_R,
		t.BELNR_3,
		t.XBLNR_2,
		t.BLART_2,
		t.ZTERM,
		t.ZFBDT,
		t.SHKZG,
		t.WAERS_3,
		t.CHCKR_CH,
		t.FEEMI_CH,
		t.FEVEN_CH,
		t.BANK_CH,
		t.SUCU_CH,
		t.WAERS_CH,
		t.KKBER_CH";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
						
			
		$sql = "update (SELECT BELNR,
		XBLNR,
		BUDAT,
		BLDAT,
		BUKRS,
		GJAHR,
		BLART,
		WAERS,
		KUNNR_R,
		AUGBL_R,
		AUGDT_R,
		BELNR_3,
		XBLNR_2,
		BLART_2,
		ZTERM,
		ZFBDT,
		SHKZG,
		WAERS_3,
		CHCKR_CH,
		FEEMI_CH,
		FEVEN_CH,
		BANK_CH,
		SUCU_CH,
		WAERS_CH,
		KKBER_CH,sum(WRBTS_3) as WRBTS_3,
		sum(DMBTR_3) as DMBTR_3,
		sum(DMBE2_3) as DMBE2_3,
		sum(WRBTR_CH) as WRBTR_CH,
		sum(DMBE2) as DMBE2,
		sum(DIASC) as DIASC,
		sum(IMPO_POND) as IMPO_POND
		
		 FROM `cobranza_crm_tmp` group by BELNR,
		XBLNR,
		BUDAT,
		BLDAT,
		BUKRS,
		GJAHR,
		BLART,
		WAERS,
		KUNNR_R,
		AUGBL_R,
		AUGDT_R,
		BELNR_3,
		XBLNR_2,
		BLART_2,
		ZTERM,
		ZFBDT,
		SHKZG,
		WAERS_3,
		CHCKR_CH,
		FEEMI_CH,
		FEVEN_CH,
		BANK_CH,
		SUCU_CH,
		WAERS_CH,
		KKBER_CH,
		DIASC,
		IMPO_POND) as t left join cobranza_crm_todo as c on t.BELNR=c.BELNR and
		t.XBLNR=c.XBLNR and
		t.BUDAT=c.BUDAT and
		t.BLDAT=c.BLDAT and
		t.BUKRS=c.BUKRS and
		t.GJAHR=c.GJAHR and
		t.BLART=c.BLART and
		t.WAERS=c.WAERS and
		t.KUNNR_R=c.KUNNR_R and
		t.AUGBL_R=c.AUGBL_R and
		t.AUGDT_R=c.AUGDT_R and
		t.BELNR_3=c.BELNR_3 and
		t.XBLNR_2=c.XBLNR_2 and
		t.BLART_2=c.BLART_2 and
		t.ZTERM=c.ZTERM and
		t.ZFBDT=c.ZFBDT and
		t.SHKZG=c.SHKZG and
		t.WAERS_3=c.WAERS_3 and
		t.CHCKR_CH=c.CHCKR_CH and
		t.FEEMI_CH=c.FEEMI_CH and
		t.FEVEN_CH=c.FEVEN_CH and
		t.BANK_CH=c.BANK_CH and
		t.SUCU_CH=c.SUCU_CH and
		t.WAERS_CH=c.WAERS_CH and
		t.KKBER_CH=c.KKBER_CH
		 set c.WRBTS_3=t.WRBTS_3,
		c.DMBTR_3=t.DMBTR_3,
		c.DMBE2_3=t.DMBE2_3,
		c.WRBTR_CH=t.WRBTR_CH,
		c.DMBE2=t.DMBE2
		 where c.id is not null";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
						
			
	/************************************************************************************
	 *     A CONTINUACION SE TRATAN RECIBOS
	 * 
	 ************************************************************************************/
		
				
		$sql = "insert IGNORE into recibo_crm_todo (XBLNR,BUKRS,BELNR,GJAHR,VBELN,BLART,FKDAT,DICOB,KUNNR,DIATR,DMBTR,DMBE2,SABTR,SABE2,WAERS) 
		SELECT t.XBLNR,t.BUKRS,t.BELNR,t.GJAHR,
		concat(t.BUKRS,t.BELNR,t.GJAHR) as VBELN,
		t.BLART,
		t.BUDAT AS FKDAT,
		0 as DICOB,
		t.KUNNR_R as kunnr,
		0 as DIATR,
		0 as DMBTR,
		0 as DMBE2,
		0 as SABTR,
		0 as SABE2,
		t.WAERS_3 as WAERS
		
		
		 FROM `cobranza_crm_tmp` as t left join `recibo_crm_todo` as r on 
		t.BELNR=r.BELNR and
		t.BUKRS=R.BUKRS and
		t.GJAHR=R.GJAHR 
		
		WHERE R.id is null AND t.XBLNR!=t.XBLNR_2  group by t.BELNR,
		t.BUKRS,
		t.GJAHR";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
						
			
		$sql = "
		update (SELECT t.XBLNR,
		t.BUKRS,
		t.BELNR,
		t.GJAHR,
		concat(t.BUKRS,t.BELNR,t.GJAHR) as VBELN,
		t.BLART,
		t.BUDAT AS FKDAT,
		0 as DICOB,
		r.KUNNR as KUNNR,
		0 as DIATR,
		sum(t.DMBTR_3) as DMBTR,
		sum(t.DMBE2_3) as DMBE2,
		0 as SABTR,
		0 as SABE2,
		t.WAERS_3 as WAERS,
		t.KKBER_CH as KKBER_CH
		
		
		 FROM `cobranza_crm_tmp` as t left join recibo_crm_todo as r on  
		t.BUKRS=r.BUKRS AND 
		t.BELNR=r.BELNR AND 
		t.GJAHR=r.GJAHR WHERE t.SHKZG='H' AND t.XBLNR=t.XBLNR_2 and r.id is not null group by t.BELNR,
		t.BUKRS,
		t.GJAHR) as h left join recibo_crm_todo as J on  
		h.BUKRS=J.BUKRS AND 
		h.BELNR=J.BELNR AND 
		h.GJAHR=J.GJAHR 
		   
		
		SET 
		J.DMBTR=h.DMBTR,
		J.DMBE2=h.DMBE2,
		J.SABTR=h.SABTR,
		J.SABE2=h.SABE2";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
					

		$sql = "
update (SELECT cb.belnr,cb.bukrs,cb.gjahr,rb.kunnr,cb.kkber_ch,cl.kunnr as kunnr_rb,cl.vkorg,cl.kunn2 FROM cobranza_crm_tmp as cb left join recibo_crm_todo as rb on rb.belnr=cb.belnr and rb.bukrs=cb.bukrs and rb.gjahr=cb.gjahr left join cliente_crm_todo as cl on cl.kunnr=rb.kunnr and cl.vkorg=if(cb.kkber_ch='ACFE','2010',if(cb.kkber_ch='ACFO','2020','2030')) where cb.xblnr=cb.xblnr_2 and cb.shkzg='h' group by rb.belnr,rb.bukrs,rb.gjahr) as recibo left join
(SELECT cb.belnr,cb.bukrs,cb.gjahr,rb.kunnr,cb.kkber_ch,cl.kunnr as kunnr_fb,cl.vkorg,cl.kunn2 FROM cobranza_crm_tmp as cb left join recibo_crm_todo as rb on rb.belnr=cb.belnr and rb.bukrs=cb.bukrs and rb.gjahr=cb.gjahr left join cliente_crm_todo as cl on cl.kunnr=rb.kunnr and cl.vkorg=if(cb.kkber_ch='ACFE','2010',if(cb.kkber_ch='ACFO','2020','2030')) where cb.xblnr<>cb.xblnr_2 and cb.shkzg='s' group by rb.belnr,rb.bukrs,rb.gjahr having max(cb.dmbe2_3)) as factura
on factura.belnr=recibo.belnr and 
   factura.bukrs=recibo.bukrs and 
   factura.gjahr=recibo.gjahr left join recibo_crm_todo on 
   recibo.belnr=recibo_crm_todo.belnr and 
   recibo.bukrs=recibo_crm_todo.bukrs and 
   recibo.gjahr=recibo_crm_todo.gjahr left join (select kunnr,kunn2,vkorg from cliente_crm_todo group by kunnr) as cliente on 
   recibo.kunnr=cliente.kunnr set 

recibo_crm_todo.kunn2=if(recibo.kunnr_rb is not null,recibo.kunn2,if(factura.kunnr_fb is not null,factura.kunn2,cliente.kunn2)),   
recibo_crm_todo.crm_id=concat(recibo_crm_todo.kunnr,if(recibo.kunnr_rb is not null,recibo.vkorg,if(factura.kunnr_fb is not null,factura.vkorg,cliente.vkorg))),
recibo_crm_todo.unneg=if(if(recibo.kunnr_rb is not null,recibo.vkorg,if(factura.kunnr_fb is not null,factura.vkorg,cliente.vkorg))='2010','Feed',if(if(recibo.kunnr_rb is not null,recibo.vkorg,if(factura.kunnr_fb is not null,factura.vkorg,cliente.vkorg))='2020','Food','Industrial'))
		";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
					

			
		
			
		$sql = "update (SELECT t.XBLNR,t.BUKRS,t.BELNR,t.GJAHR,concat(t.BUKRS,t.BELNR,t.GJAHR) as VBELN,sum(t.IMPO_POND) as DICOB, sum(if(shkzg='s',dmbtr_3,0)) as total_impo_peso FROM `cobranza_crm_tmp` as t WHERE t.XBLNR!=t.XBLNR_2 group by t.BELNR,t.BUKRS,t.GJAHR ) as h left join recibo_crm_todo as r on h.BUKRS=r.BUKRS AND h.BELNR=r.BELNR AND h.GJAHR=r.GJAHR 
		
		SET 
		r.DIATR=h.DICOB/h.total_impo_peso
		
		 where r.id is not null";   // aca se manda los dias cobranza a dias atrazo por que esta mal mapeado en el CRM
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
					
/**/			
		$sql_ok = true; 
		$sql = "COMMIT";     
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
	} catch (Exception $e) {
		$sql = "ROLLBACK";  
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			$serv->pongo_hayError($sql."||".$e);
		}
		
	}	
		
	
?>

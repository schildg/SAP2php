<?php
	$serv->set_subestado("procesando Clientes CRM");

/*	$sql="DELETE FROM cliente_crm WHERE date_concurrency <= DATE_SUB(NOW(), INTERVAL 1 HOUR)";
	try { //BORRAMOS TODAS LAS NOVEDADES CON MAS DE UNA HORA
		MyActiveRecord :: Query($sql);
	} catch (Exception $e) {
		$serv->pongo_hayError($sql."||".$e);
		$sql_ok = false;
	}
*/
	$sql = "START TRANSACTION";
	try {
		MyActiveRecord :: Query($sql);
	
		$sql = "UPDATE CLIENTE_CRM_TODO SET DMA120=0, DMA090=0,DMA060=0,DMA030=0,DME030=0,DNOVE=0,VALPRO=0,VALREC=0,VALTER=0,TVALO=0,TDEUDA=0,PDMA120=0, PDMA090=0,PDMA060=0,PDMA030=0,PDME030=0,PDNOVE=0,PVALPRO=0,PVALREC=0,PVALTER=0,PTVALO=0,PTDEUDA=0";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
				
		$sql = "UPDATE CLIENTE_CRM_TODO AS CL,
			(select kunnr,vkorg,sum(DMA120) as DMA120,sum(DMA090) as DMA090,sum(DMA060) as DMA060,sum(DMA030) as DMA030,sum(DME030) as DME030,sum(DNOVE) as DNOVE,sum(PDMA120) as PDMA120,sum(PDMA090) as PDMA090,sum(PDMA060) as PDMA060,sum(PDMA030) as PDMA030,sum(PDME030) as PDME030,sum(PDNOVE) as PDNOVE from (SELECT KUNNR,vkorg,
			if(CLAS = 'DMA120', IMPD, 0) AS `DMA120`, 
			if(CLAS = 'DMA090', IMPD, 0) AS `DMA090`, 
			if(CLAS = 'DMA060', IMPD, 0) AS `DMA060`, 
			if(CLAS = 'DMA030', IMPD, 0) AS `DMA030`, 
			If(CLAS = 'DME030', IMPD, 0) AS `DME030`, 
			if(CLAS = 'DNOVE', IMPD, 0) AS `DNOVE`,
			if(CLAS = 'DMA120', IMPP, 0) AS `PDMA120`, 
			if(CLAS = 'DMA090', IMPP, 0) AS `PDMA090`, 
			if(CLAS = 'DMA060', IMPP, 0) AS `PDMA060`, 
			if(CLAS = 'DMA030', IMPP, 0) AS `PDMA030`, 
			If(CLAS = 'DME030', IMPP, 0) AS `PDME030`, 
			if(CLAS = 'DNOVE', IMPP, 0) AS `PDNOVE`
			FROM (SELECT KUNNR,vkorg,SUM(DMBE2) AS IMPD,SUM(DMBTR) AS IMPP, 
			IF (VENCIDO >=120,'DMA120',
			IF (VENCIDO >=90,'DMA090',
			IF (VENCIDO >=60,'DMA060',
			IF (VENCIDO >=30,'DMA030',
			IF (VENCIDO >=0,'DME030','DNOVE'))))) AS CLAS FROM (SELECT KUNNR,vkorg,cp.zterm,zfbdt,datediff(now(),adddate(zfbdt,INTERVAL ztag1 DAY)) as VENCIDO,
			IF (SHKZG='H',DMBE2*-1,DMBE2 ) AS DMBE2,
			IF (SHKZG='H',DMBTR*-1,DMBTR ) AS DMBTR
			 FROM `deuda_crm_tmp` as ind,condicion_pago as cp where cp.zterm=ind.zterm AND cp.ZTAGG = 0) AS DEUDA GROUP BY KUNNR,vkorg,CLAS) AS DEU1 ) as deu3 group by kunnr,vkorg
			) AS DEU2 
			
			SET CL.DMA120=DEU2.DMA120, CL.DMA090=DEU2.DMA090, CL.DMA060=DEU2.DMA060, CL.DMA030=DEU2.DMA030, CL.DME030=DEU2.DME030, CL.DNOVE=DEU2.DNOVE, CL.TDEUDA=DEU2.DMA120+DEU2.DMA090+DEU2.DMA060+DEU2.DMA030+DEU2.DME030+DEU2.DNOVE,
			    CL.PDMA120=DEU2.PDMA120, CL.PDMA090=DEU2.PDMA090, CL.PDMA060=DEU2.PDMA060, CL.PDMA030=DEU2.PDMA030, CL.PDME030=DEU2.PDME030, CL.PDNOVE=DEU2.PDNOVE, CL.PTDEUDA=DEU2.PDMA120+DEU2.PDMA090+DEU2.PDMA060+DEU2.PDMA030+DEU2.PDME030+DEU2.PDNOVE
			 WHERE DEU2.KUNNR=CL.KUNNR and DEU2.vkorg=CL.vkorg";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
				
		$sql_ok = true;  //actualizo EL ESTADO DE los valores   
		$sql = "UPDATE cliente_crm_todo as c, (SELECT ch.bukrs,if(kkber='ACFE',2010,if(kkber='ACFO',2020,2030)) as vkorg,ch.kunnr,SUM(if(ch.estad='RCH',ch.dmbe2,0)) as VALREC,SUM(if(ch.tpchk='T',ch.dmbe2,0)) as VALTER,SUM(if(ch.tpchk='P',ch.dmbe2,0)) as VALPRO,sum(ch.dmbe2) as TVALO,SUM(if(ch.estad='RCH',ch.WRBTR,0)) as PVALREC,SUM(if(ch.tpchk='T',ch.WRBTR,0)) as PVALTER,SUM(if(ch.tpchk='P',ch.WRBTR,0)) as PVALPRO,sum(ch.WRBTR) as PTVALO  FROM cheques_crm_todo as ch where (ch.ESTAD<>'ACR')  GROUP BY ch.kunnr,ch.bukrs,ch.kkber) AS D SET c.VALPRO=D.VALPRO,c.VALREC=D.VALREC,c.VALTER=D.VALTER,c.TVALO=D.TVALO,c.PVALPRO=D.PVALPRO,c.PVALREC=D.PVALREC,c.PVALTER=D.PVALTER,c.PTVALO=D.PTVALO WHERE D.KUNNR=c.KUNNR and c.BUKRS=D.BUKRS and c.vkorg=D.vkorg";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			echo "ERROR::".$sql."||".$e."\r\n";
			throw ($e);
		}
					
		
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
		
		$reg_ult_act = new Actualizacion_CRM("Cliente_CRM");
		$reg_ult_act->save();
	
		
?>
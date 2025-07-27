
 {if !$exportarPlanCal}
<table summary=" Monitor de Errores arrojados por SAP  " border="0">
	<tbody>
		<td>
		<h1> Monitor de Errores arrojados por SAP  </h1>
		</td>
		<td>
		<div id="contab-herramienta"> <a
			href="{$self|regex_replace:"
			/index.php/":""}manExort.php?accion=generarReporteErrores " TARGET='_blank'><img
			class="iconos" src="css-imgs/planCal.png" alt="Exportar el listado"
			title="Exportar el listado" />Exportar el listado</a></div>
		</td>
	</tbody>
</table>
{else}
<h1> Monitor de Errores arrojados por SAP  </h1>
{/if}

<hr>
<div class="lista">
<table summary="Estado de las OF's">
	<tbody>
		<tr>
		{foreach from=$estado item=est}
			<th>{$est["estado"]}</th>
			<td>{$est["cuenta"]}</td>
		{/foreach}
		</tr>
	</tbody>
</table>
</div>
<hr>

<form action="{$self}" method="post">
   <table summary="Datos de FILTRO de HF's" border="0" >
    <tbody>
	  <tr>
	    <th>Fecha de inicio</th>
	     {if !$exportarPlanCal}
		<td><input  tabindex="1" type="text" id="fecha_1" name="fecha_1" value="{$fecha_1|date_format:"%d/%m/%Y"}" />
						  <a href="" id="trigger_fecha_1" ><img class="calendario" src="css-imgs/cal.png" alt="Ver Calendario" title="Ver Calendario"/></a>
		                  {dhtml_calendar inputField=fecha_1 button="trigger_fecha_1" singleClick=true}
		</td>
		{else}<td>{$fecha_1|date_format:"%d/%m/%Y"}</td>
		{/if}
		</tr><tr>
	    <th>Fecha de finalizacion</th>
	     {if !$exportarPlanCal}	    
		<td><input  tabindex="1" type="text" id="fecha_2" name="fecha_2" value="{$fecha_2|date_format:"%d/%m/%Y"}" />
						  <a href="" id="trigger_fecha_2" ><img class="calendario" src="css-imgs/cal.png" alt="Ver Calendario" title="Ver Calendario"/></a>
		                  {dhtml_calendar inputField=fecha_2 button="trigger_fecha_2" singleClick=true}
		</td>
		{else}<td>{$fecha_2|date_format:"%d/%m/%Y"}</td>
		{/if}
	  </tr>
	  <tr>
	  			<th><input value="Generar" tabindex="1" type="submit" /> 
				<input type="hidden" name="accion" value="generarReporteErrores" /></th>
	  </tr>
	</tbody></table>
 </form>
 
<hr>
<h2>Existen {count($consulta)} Errores</h2> 
<div class="lista">
<table class="lista" summary="Monitor de Errores" border="0">
	<tbody>
		<tr>
   		 {if !$exportarPlanCal}
			<th title="Declarado en SAP">Declarado en SAP<a href="{$self}?accion=generarReporteErrores&amp;campoorden=declarado_en_sap&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarReporteErrores&amp;campoorden=declarado_en_sap&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Estado">Estado<a href="{$self}?accion=generarReporteErrores&amp;campoorden=estado&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarReporteErrores&amp;campoorden=estado&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Accion">Accion</th>
			<th title="Tarea">Tarea<a href="{$self}?accion=generarReporteErrores&amp;campoorden=nmov_lt&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarReporteErrores&amp;campoorden=nmov_lt&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="UT">UT<a href="{$self}?accion=generarReporteErrores&amp;campoorden=utor_lt&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarReporteErrores&amp;campoorden=utor_lt&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Codigo">Codigo<a href="{$self}?accion=generarReporteErrores&amp;campoorden=codigo&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarReporteErrores&amp;campoorden=codigo&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Numero">Numero<a href="{$self}?accion=generarReporteErrores&amp;campoorden=numero&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarReporteErrores&amp;campoorden=numero&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="OF SAP">OF SAP<a href="{$self}?accion=generarReporteErrores&amp;campoorden=numero_sap&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarReporteErrores&amp;campoorden=numero_sap&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Cantidad">Cantidad<a href="{$self}?accion=generarReporteErrores&amp;campoorden=cant_lt&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarReporteErrores&amp;campoorden=cant_lt&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Fecha HF">Fecha HF<a href="{$self}?accion=generarReporteErrores&amp;campoorden=fech_sd&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarReporteErrores&amp;campoorden=fech_sd&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Id obejto sap">Id obejto sap<a href="{$self}?accion=generarReporteErrores&amp;campoorden=id_objeto_sap&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarReporteErrores&amp;campoorden=id_objeto_sap&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="RFC">RFC<a href="{$self}?accion=generarReporteErrores&amp;campoorden=rfc&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarReporteErrores&amp;campoorden=rfc&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Tipo">Tipo<a href="{$self}?accion=generarReporteErrores&amp;campoorden=type&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarReporteErrores&amp;campoorden=type&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Nro Error">Nro Error<a href="{$self}?accion=generarReporteErrores&amp;campoorden=number&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarReporteErrores&amp;campoorden=number&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Mensaje">Mensaje<a href="{$self}?accion=generarReporteErrores&amp;campoorden=message&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarReporteErrores&amp;campoorden=message&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Material">Material<a href="{$self}?accion=generarReporteErrores&amp;campoorden=matnr&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarReporteErrores&amp;campoorden=matnr&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Lote">Lote<a href="{$self}?accion=generarReporteErrores&amp;campoorden=charg&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarReporteErrores&amp;campoorden=charg&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="HU">HU<a href="{$self}?accion=generarReporteErrores&amp;campoorden=exidv_ob&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarReporteErrores&amp;campoorden=exidv_ob&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
   		{else}
			<th title="Declarado en SAP">Declarado en SAP</th>
			<th title="Estado">Estado</th>
			<th title="Accion">Accion</th>
			<th title="Tarea">Tarea</th>
			<th title="UT">UT</th>
			<th title="Codigo">Codigo</th>
			<th title="Numero">Numero</th>
			<th title="OF SAP">OF SAP</th>
			<th title="Cantidad">Cantidad</th>
			<th title="Fecha HF">Fecha HF</th>
			<th title="Id obejto sap">Id obejto sap</th>
			<th title="RFC">RFC</th>
			<th title="Tipo">Tipo</th>
			<th title="Nro Error">Nro Error</th>
			<th title="Mensaje">Mensaje</th>
			<th title="Material">Material</th>
			<th title="Lote">Lote</th>
			<th title="HU">HU</th>
		{/if} 
			<th colspan="1"></th>
			
		</tr>
		{foreach from=$consulta item=cons}
		<tr onmouseout="this.bgColor='Linen'"
			onmouseover="this.bgColor='Coral'">
			<td>{$cons["declarado_en_sap"]}</td>
			<td>{$cons["estado"]}</td>
			<td nowrap>
	   		 {if !$exportarPlanCal}
				{if $cons["estado"]=="CSx"}
						<div><a href="{$self}?id_tarea={$cons["nmov_lt"]}&amp;accion=generarReporteErrores&amp;SubAction=PasarParticionar&amp;id_of_sap={$cons["numero_sap"]}"><img
						 height=32px src="css-imgs/letra_p.png" alt="mandar a particionar"
						title="mandar a particionar" /></a>
						<a href="{$self}?id_tarea={$cons["nmov_lt"]}&amp;accion=generarReporteErrores&amp;SubAction=AConsumir&amp;id_of_sap={$cons["numero_sap"]}"><img
						 height=32px src="css-imgs/letra_c.png" alt="mandar a consumir"
						title="mandar a consumir" /></a></div>
	            {else}
					{if $cons["estado"]=="PAx"}
						<div><a href="{$self}?id_tarea={$cons["nmov_lt"]}&amp;accion=generarReporteErrores&amp;SubAction=AParticionar&amp;id_of_sap={$cons["numero_sap"]}"><img
						 height=32px src="css-imgs/letra_p.png" alt="mandar a particionar"
						title="mandar a particionar" /></a>
		            {/if}			 	
	            {/if}			 	
            {/if}			 	
			</td>
			<td>{$cons["nmov_lt"]}</td>
			<td>{$cons["utor_lt"]}</td>
			<td>{$cons["codigo"]}</td>
			<td>{$cons["numero"]}</td>
			<td>{$cons["numero_sap"]}</td>
			<td>{$cons["cant_lt"]}</td>
			<td>{$cons["fech_sd"]}</td>
			<td>{$cons["id_objeto_sap"]}</td>
			<td>{$cons["rfc"]}</td>
			<td>{$cons["type"]}</td>
			<td>{$cons["number"]}</td>
			<td>{$cons["message"]}</td>
			<td>{$cons["matnr"]}</td>
			<td>{$cons["charg"]}</td>
			<td>{$cons["exidv_ob"]}</td>
			<td width="1%"><a
	   		 {if !$exportarPlanCal}
				href="{$self}?id_tarea={$cons["nmov_lt"]}&amp;accion=detalleErrorSAP"><img
				class="ordenar" src="css-imgs/editar.png" alt="Detalles del Error SAP"
				title="Detalles del Error SAP" /></a>
			 {/if}
			</td>

		</tr>
		{/foreach}
	</tbody>
</table>
</div>

 
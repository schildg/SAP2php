
 {if !$exportarPlanCal}
<table summary=" Reporte de Ventas SAP  " border="0">
	<tbody>
		<td>
		<h1> Reporte de Ventas SAP  </h1>
		</td>
		<td>
		<div id="contab-herramienta"> <a
			href="{$self|regex_replace:"
			/index.php/":""}manExort.php?accion=generarRptVentas " TARGET='_blank'><img
			class="iconos" src="css-imgs/planCal.png" alt="Exportar el listado"
			title="Exportar el listado" />Exportar el listado</a></div>
		</td>
	</tbody>
</table>
{else}
<h1> Reporte de Ventas SAP  </h1>
{/if}


<form action="{$self}" method="post">
   <table summary="Datos de Ventas" border="0" >
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
	  <tr><th>Org. Ventas</th>
	    {if !$exportarPlanCal}
			<td><select name="org_vta" tabindex="1">
			{foreach from=$org_ventas item=tabl1} 
				{if $org_vta== $tabl1["VKORG"]}
				<option label="{$tabl1["VKORG"]}" selected="selected"
					value="{$tabl1["VKORG"]}">{$tabl1["VKORG"]}</option>
				{else}
				<option label="{$tabl1["VKORG"]}" value="{$tabl1["VKORG"]}">{$tabl1["VKORG"]}</option>
				{/if} 
			{/foreach}
			</select></td>		
		{else}<td>{$org_vta}</td>
		{/if}
	  </tr>
	  <tr><th>Sociedad</th>
	    {if !$exportarPlanCal}
			<td><select name="sociedad" tabindex="1">
			{foreach from=$sociedades item=tabl2} 
				{if $sociedad== $tabl2["BUKRS"]}
				<option label="{$tabl2["BUKRS"]}" selected="selected"
					value="{$tabl2["BUKRS"]}">{$tabl2["BUKRS"]}</option>
				{else}
				<option label="{$tabl2["BUKRS"]}" value="{$tabl2["BUKRS"]}">{$tabl2["BUKRS"]}</option>
				{/if} 
			{/foreach}
			</select></td>		
		{else}<td>{$sociedad}</td>
		{/if}
	  </tr>
	  
	  <tr>
	  			<th><input value="Generar" tabindex="1" type="submit" /> 
				<input type="hidden" name="accion" value="generarRptVentas" /></th>
	  </tr>
	</tbody></table>
 </form>
 
<hr>
<h2>Existen {count($consulta)} Registros</h2> 
<div class="lista">
<table class="lista" summary="Reporte Ventas" border="0">
	<tbody>
		<tr>
   		 {if !$exportarPlanCal}
			<th title="Sociedad">Sociedad<a href="{$self}?accion=generarRptVentas&amp;campoorden=bukrs&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentas&amp;campoorden=bukrs&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Org.Venta">Org.Venta<a href="{$self}?accion=generarRptVentas&amp;campoorden=vkorg&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentas&amp;campoorden=vkorg&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Periodo">Periodo<a href="{$self}?accion=generarRptVentas&amp;campoorden=perio&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentas&amp;campoorden=perio&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Cod.Cliente">Cod.Cliente<a href="{$self}?accion=generarRptVentas&amp;campoorden=kunnr&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentas&amp;campoorden=kunnr&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Descripcion del Cliente">Descripcion del Cliente<a href="{$self}?accion=generarRptVentas&amp;campoorden=name1&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentas&amp;campoorden=name1&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Cod.Vendedor">Cod.Vendedor<a href="{$self}?accion=generarRptVentas&amp;campoorden=kunn2&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentas&amp;campoorden=kunn2&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Nombre del Vendedor">Nombre del Vendedor<a href="{$self}?accion=generarRptVentas&amp;campoorden=name2&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentas&amp;campoorden=name2&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Cod.Vendedor Actual">Cod.Vendedor Actual<a href="{$self}?accion=generarRptVentas&amp;campoorden=vcart&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentas&amp;campoorden=vcart&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Nombre del Vendedor Actual">Nombre del Vendedor Actual<a href="{$self}?accion=generarRptVentas&amp;campoorden=name3&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentas&amp;campoorden=name3&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Material">Material<a href="{$self}?accion=generarRptVentas&amp;campoorden=matnr&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentas&amp;campoorden=matnr&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Descripcion Material">Descripcion Material<a href="{$self}?accion=generarRptVentas&amp;campoorden=matkg&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentas&amp;campoorden=matkg&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Cantidad">Cantidad<a href="{$self}?accion=generarRptVentas&amp;campoorden=kilos&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentas&amp;campoorden=kilos&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Importe">Importe<a href="{$self}?accion=generarRptVentas&amp;campoorden=impo&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentas&amp;campoorden=impo&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Costo">Costo<a href="{$self}?accion=generarRptVentas&amp;campoorden=costo&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentas&amp;campoorden=costo&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Renta">Renta<a href="{$self}?accion=generarRptVentas&amp;campoorden=renta&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentas&amp;campoorden=renta&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
   		{else}
			<th title="Sociedad">Sociedad</th>
			<th title="Org.Venta">Org.Venta</th>
			<th title="Periodo">Periodo</th>
			<th title="Cod.Cliente">Cod.Cliente"</th>
			<th title="Descripcion del Cliente">Descripcion del Cliente</th>
			<th title="Cod.Vendedor">Cod.Vendedor</th>
			<th title="Nombre del Vendedor">Nombre del Vendedor</th>
			<th title="Cod.Vendedor Actual">Cod.Vendedor Actual</th>
			<th title="Nombre del Vendedor Actual">Nombre del Vendedor Actual</th>
			<th title="Material">Material</th>
			<th title="Descripcion Material">Descripcion Material</th>
			<th title="Cantidad">Cantidad</th>
			<th title="Importe">Importe</th>
			<th title="Costo">Costo</th>
			<th title="Renta">Renta</th>
		{/if} 
			<th colspan="1"></th>
			
		</tr>
		{foreach from=$consulta item=cons}
		<tr onmouseout="this.bgColor='Linen'"
			onmouseover="this.bgColor='Coral'">
			<td>{$cons["bukrs"]}</td>
			<td>{$cons["vkorg"]}</td>
			<td>{$cons["perio"]}</td>
			<td>{$cons["kunnr"]}</td>
			<td>{$cons["name1"]}</td>
			<td>{$cons["kunn2"]}</td>
			<td>{$cons["name2"]}</td>
			<td>{$cons["vcart"]}</td>
			<td>{$cons["name3"]}</td>
			<td>{$cons["matnr"]}</td>
			<td>{$cons["maktg"]}</td>
			<td>{$cons["kilos"]}</td>
			<td>{$cons["impo"]}</td>
			<td>{$cons["costo"]}</td>
			<td>{$cons["renta"]}</td>
			<td width="1%">
			</td>

		</tr>
		{/foreach}
	</tbody>
</table>
</div>

 
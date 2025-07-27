
 {if !$exportarPlanCal}
<table summary=" Reporte de Ventas Acumulado  " border="0">
	<tbody>
		<td>
		<h1> Reporte de Ventas Acumulado  </h1>
		</td>
		<td>
		<div id="contab-herramienta"> <a
			href="{$self|regex_replace:"
			/index.php/":""}manExort.php?accion=generarRptVentasAcum " TARGET='_blank'><img
			class="iconos" src="css-imgs/planCal.png" alt="Exportar el listado"
			title="Exportar el listado" />Exportar el listado</a></div>
		</td>
	</tbody>
</table>
{else}
<h1> Reporte de Ventas Acumulado  </h1>
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
	  <tr><th>Vendedor</th>
	    {if !$exportarPlanCal}
			<td><select name="vendedor" tabindex="1">
			{foreach from=$vendedores item=tabl} 
				{if $vendedor== $tabl["KUNNR"]}
				<option label="{$tabl["NAME1"]}" selected="selected"
					value="{$tabl["KUNNR"]}">{$tabl["KUNNR"]} - {$tabl["NAME1"]}</option>
				{else}
				<option label="{$tabl["NAME1"]}" value="{$tabl["KUNNR"]}">{$tabl["KUNNR"]} - {$tabl["NAME1"]}</option>
				{/if} 
			{/foreach}
			</select></td>		
		{else}<td>{$vendedor}</td>
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
	  <tr><th>Clasificacion</th>
	    {if !$exportarPlanCal}
			<td><select name="clasf" tabindex="1">
			{foreach from=$clasificacion item=tabl3} 
				{if $clasf== $tabl3}
				<option label="{$tabl3}" selected="selected"
					value="{$tabl3}">{$tabl3}</option>
				{else}
				<option label="{$tabl3}" value="{$tabl3}">{$tabl3}</option>
				{/if} 
			{/foreach}
			</select></td>		
		{else}<td>{$clasf}</td>
		{/if}
	  </tr>

	  <tr>
	  			<th><input value="Generar" tabindex="1" type="submit" /> 
				<input type="hidden" name="accion" value="generarRptVentasAcum" /></th>
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
			<th title="Sociedad">Sociedad<a href="{$self}?accion=generarRptVentasAcum&amp;campoorden=bukrs&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentasAcum&amp;campoorden=bukrs&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Org.Venta">Org.Venta<a href="{$self}?accion=generarRptVentasAcum&amp;campoorden=vkorg&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentasAcum&amp;campoorden=vkorg&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Cod.Cliente">Cod.Cliente<a href="{$self}?accion=generarRptVentasAcum&amp;campoorden=kunnr&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentasAcum&amp;campoorden=kunnr&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Descripcion del Cliente">Descripcion del Cliente<a href="{$self}?accion=generarRptVentasAcum&amp;campoorden=name1&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentasAcum&amp;campoorden=name1&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Cod.Vendedor">Cod.Vendedor<a href="{$self}?accion=generarRptVentasAcum&amp;campoorden=kunn2&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentasAcum&amp;campoorden=kunn2&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Nombre del Vendedor">Nombre del Vendedor<a href="{$self}?accion=generarRptVentasAcum&amp;campoorden=name2&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentasAcum&amp;campoorden=name2&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Material">Material<a href="{$self}?accion=generarRptVentasAcum&amp;campoorden=matnr&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentasAcum&amp;campoorden=matnr&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Descripcion Material">Descripcion Material<a href="{$self}?accion=generarRptVentasAcum&amp;campoorden=matkg&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentasAcum&amp;campoorden=matkg&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
            {foreach from=$periodo item=per} 
				<th title="{$per}">{$per}<a href="{$self}?accion=generarRptVentasAcum&amp;campoorden={$per}&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
	                                            				href="{$self}?accion=generarRptVentasAcum&amp;campoorden={$per}&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			{/foreach}
			<th title="Total">Total<a href="{$self}?accion=generarRptVentasAcum&amp;campoorden=total&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentasAcum&amp;campoorden=total&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Ventas Ultimos 12 meses Cliente">Ventas Ultimos 12 meses Cliente<a href="{$self}?accion=generarRptVentasAcum&amp;campoorden=venta_cliente&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentasAcum&amp;campoorden=venta_cliente&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Ventas ultimos 12 meses Cliente - Producto">Ventas ultimos 12 meses Cliente - Producto<a href="{$self}?accion=generarRptVentasAcum&amp;campoorden=venta_material&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentasAcum&amp;campoorden=venta_material&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Clasificacion">Clasificacion<a href="{$self}?accion=generarRptVentasAcum&amp;campoorden=Clasificacion&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="{$self}?accion=generarRptVentasAcum&amp;campoorden=Clasificacion&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
   		{else}
			<th title="Sociedad">Sociedad</th>
			<th title="Org.Venta">Org.Venta</th>
			<th title="Cod.Cliente">Cod.Cliente</th>
			<th title="Descripcion del Cliente">Descripcion del Cliente</th>
			<th title="Cod.Vendedor">Cod.Vendedor</th>
			<th title="Nombre del Vendedor">Nombre del Vendedor</th>
			<th title="Material">Material</th>
			<th title="Descripcion Material">Descripcion Material</th>
			{foreach from=$periodo item=per} 
				<th title="{$per}">{$per}</th>
			{/foreach}
			
			<th title="Total">Total</th>
			<th title="Ventas Ultimos 12 meses Cliente">Ventas Ultimos 12 meses Cliente</th>
			<th title="Ventas ultimos 12 meses Cliente - Producto">Ventas ultimos 12 meses Cliente - Producto</th>
			<th title="Clasificacion">Clasificacion</th>
		{/if} 
			<th colspan="1"></th>
			
		</tr>
		{foreach from=$consulta item=cons}
		<tr onmouseout="this.bgColor='Linen'"
			onmouseover="this.bgColor='Coral'">
			<td>{$cons["bukrs"]}</td>
			<td>{$cons["vkorg"]}</td>
			<td>{$cons["kunnr"]}</td>
			<td>{$cons["name1"]}</td>
			<td>{$cons["kunn2"]}</td>
			<td>{$cons["name2"]}</td>
			<td>{$cons["matnr"]}</td>
			<td>{$cons["maktg"]}</td>
			{foreach from=$periodo item=per} 
				<td>{$cons["$per"]}</td>
			{/foreach}
			<td>{$cons["total"]}</td>
			<td>{$cons["venta_cliente"]}</td>
			<td>{$cons["venta_material"]}</td>
			<td>{$cons["Clasificacion"]}</td>
			
			<td width="1%">
			</td>

		</tr>
		{/foreach}
	</tbody>
</table>
</div>

 
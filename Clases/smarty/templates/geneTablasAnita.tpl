<h1>Generador de Tablas de Anita</h1>
<form action="{$self}" method="post">
<table summary="Generador de Tablas de Anita" border="0">
	<tbody>
		<tr>
			<th>
			<h2>Seleccione una Tabla del sistema Anita (sf-arch.inx)</h2>
			</th>
			<th><select name="sf_arc_id" tabindex="1">
				{if $sf_arc->id == 0}
				<option label="-- NADA --" selected="selected" value="0">-- NADA --</option>
				{else}
				<option label="-- NADA --" value="0">-- NADA --</option>
				{/if} 
				{foreach from=$relacion->FindAll('Sf_Arc','nsap_sf = 1') item=arc}
					{if $sf_arc->id == $arc->id}
					<option label="{$arc->leyenda()}" selected="selected"
						value="{$arc->id}">{$arc->leyenda()}</option>
					{else}
					<option label="{$arc->leyenda()}" value="{$arc->id}">{$arc->leyenda()}</option>
					{/if} 
				{/foreach}
			</select>
			<th><input value="Generar" tabindex="1" type="submit" /> 
				<input type="hidden" name="accion" value="generarTablasAnita" /></th>
			<tr>
			</tr>
	
	</tbody>
</table>

</form>


{if $arreglo_sql_completo}
<div class="lista">
<table class="lista" summary="Resultado de las SQL" border="0">
	<tbody>
		<tr>
			<th>SQL</th>
			<th colspan="1"></th>
			
		</tr>
		{foreach from=$arreglo_sql_completo item=arre}
		<tr onmouseout="this.bgColor='Linen'"
			onmouseover="this.bgColor='Coral'">
			<td>{$arre.sql}</td>
			<td width="1%">
				{if $arre.error}
					<img class="ordenar" src="css-imgs/error_sql.png" alt="{$arre.mensaje_e}" title="{$arre.mensaje_e}" />
				{else}
					<img class="ordenar" src="css-imgs/ok_sql.png" alt="SQL ok" title="SQL ok" />
				{/if}
			</td>
		</tr>
		{/foreach}
	</tbody>
</table>
</div>

<br>
<br>
<br>


<div class="lista">
<table class="lista" summary="Resultado de las SQL" border="0">
	<tbody>
		<tr>
			<th>Carga del Diccionario de Datos</th>
			<th colspan="1"></th>
			
		</tr>
		{foreach from=$arreglo_sql_completo_diccionario item=arre}
		<tr onmouseout="this.bgColor='Linen'"
			onmouseover="this.bgColor='Coral'">
			<td>{$arre.sql}</td>
			<td width="1%">
				{if $arre.error}
					<img class="ordenar" src="css-imgs/error_sql.png" alt="{$arre.mensaje_e}" title="{$arre.mensaje_e}" />
				{else}
					<img class="ordenar" src="css-imgs/ok_sql.png" alt="SQL ok" title="SQL ok" />
				{/if}
			</td>
		</tr>
		{/foreach}
	</tbody>
</table>
</div>




{/if}
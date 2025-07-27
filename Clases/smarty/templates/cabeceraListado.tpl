 {if !$exportarPlanCal}
<table summary="{$titulo}" border="0">
	<tbody>
		<td>
		<h2>{$titulo}</h2>
		</td>
		<td>
		<div id="contab-herramienta">{if $tipoListado=='filtro'} <a
			href="{$self|regex_replace:"
			/index.php/":""}manPDF.php?accion={$OBJETO}PDF " TARGET='_blank'><img
			class="iconos" src="css-imgs/pdf.png" alt="Generar PDF del listado"
			title="Generar PDF del listado" />Generar PDF del listado</a> {/if} <a
			href="{$self|regex_replace:"
			/index.php/":""}manExort.php?accion={$Accion} " TARGET='_blank'><img
			class="iconos" src="css-imgs/planCal.png" alt="Exportar el listado"
			title="Exportar el listado" />Exportar el listado</a></div>
		</td>
	</tbody>
</table>
{else}
<h2>{$titulo}</h2>
{/if}



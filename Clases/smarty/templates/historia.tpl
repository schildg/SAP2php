
<h2>Historial de los Movimientos</h2>
<div class="lista">
<table class="lista" summary="Listado de historial de movimientos"
	border="0">
	<tbody>
		<tr>
			<th>Usuario que modifico</th>
			<th>Campo</th>
			<th>Valor Anterior</th>
			<th>Fecha y Hora de Modificacion</th>

			{foreach from=$listaHistoria item=historia}
			<tr onmouseout="this.bgColor='Linen'"
				onmouseover="this.bgColor='Coral'">
				<td>{$historia->getUsuario()}</td>
				<td>{$historia->nombreCampo($historia->objeto,$historia->campo)}</td>
				<td>{if $objeto->GetType($OBJETO,$historia->campo)=="tinyint"} {if
				$historia->valor_anterior == 1} SI {else} NO {/if} {else} {if
				$objeto->GetType($OBJETO,$historia->campo)=="char"}
				{$tabla->campo($OBJETO,$historia->campo,$historia->valor_anterior)}
				{else} {if $objeto->GetType($OBJETO,$historia->campo)=="date"}
				{$historia->valor_anterior|date_format:"%d/%m/%Y" } {else} {if
				$objeto->esForaneo($historia->campo)} {
				$historia->detalleListado($OBJETO,$historia->campo,$historia->valor_anterior)
				} {else} {$historia->valor_anterior} {/if} {/if} {/if} {/if}</td>
				<td>{$historia->fecha|date_format:"%d/%m/%Y %H:%M:%S"}</td>
			</tr>
			{/foreach}
	
	</tbody>
</table>
</div>



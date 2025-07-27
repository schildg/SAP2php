<div class="lista">
<table class="lista" summary="{$titulo}" border="0">
	<tbody>
		<tr>
			{foreach key=k item=v from=$columna} {if !$exportarPlanCal}
			<th title="{$k}">{$objeto->rotulo($k)}<a
				href="{$self}?accion={$tipoListado}{$SUBOBJETO}&amp;campoorden={$k}&amp;orden=DESC">
			<img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc"
				title="Ordenar Descendente" /> </a><a
				href="{$self}?accion={$tipoListado}{$SUBOBJETO}&amp;campoorden={$k}&amp;orden=ASC">
			<img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc"
				title="Ordenar Ascendente" /> </a></th>
			{else}
			<th>{$objeto->rotulo($k)}</th>
			{/if} {/foreach}
			<th colspan="2"></th>
		</tr>
		{foreach from=$listaObjetos item=obj}
		<tr onmouseout="this.bgColor='Linen'"
			onmouseover="this.bgColor='Coral'">
			{include file="tipo-dato-listador.tpl"} {if !$exportarPlanCal}
			<td width="2%"><a
				href="{$self}?id={$obj->id}&amp;accion=editar{$SUBOBJETO}&amp;subaccion=editar"><img
				class="ordenar" src="css-imgs/editar.png" alt="Editar {$SUBOBJETO}"
				title="Editar {$SUBOBJETO}" /></a></td>
			<td width="2%"><a
				href="{$self}?id={$obj->id}&amp;accion=editar{$SUBOBJETO}&amp;subaccion=borrar"><img
				class="ordenar" src="css-imgs/borrar.png"
				alt="Eliminar {$SUBOBJETO}" title="Eliminar {$SUBOBJETO}" /></a></td>
			{/if}
		</tr>
		{/foreach}

	</tbody>
</table>
</div>



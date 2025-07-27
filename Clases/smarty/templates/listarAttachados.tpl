
<h2>Listado de Attachs</h2>
<div class="lista">
<table class="lista" summary="Listado de Attachs" border="0">
	<tbody>
		<tr>
			{foreach key=k item=v from=$columna}
			<th>{$objeto->rotulo($k)}<a
				href="{$self}?accion=VerAttach{$obje}&amp;objeto_id={$obje_id}&amp;campoorden={$k}&amp;orden=DESC">
			<img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc"
				title="Ordenar Descendente" /> </a><a
				href="{$self}?accion=VerAttach{$obje}&amp;objeto_id={$obje_id}&amp;campoorden={$k}&amp;orden=ASC">
			<img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc"
				title="Ordenar Ascendente" /> </a></th>
			{/foreach}
			<th colspan="3"></th>
		</tr>
		{foreach from=$listaObjetos item=obj}
		<tr onmouseout="this.bgColor='Linen'"
			onmouseover="this.bgColor='Coral'">
			{include file="tipo-dato-listador.tpl"}
			<td><a href="file.php?miniatura=0&amp;attach={$obj->id}"
				TARGET='_blank'
				onmouseover="return OLgetAJAX('file.php?miniatura=1&amp;attach={$obj->id}',
	    function salida(){ldelim}{'overlib(OLhttp.responseText, MOUSEOFF, NOFOLLOW, VAUTO, HAUTO, BORDER, 0, WRAP)'}{rdelim}, 100);"
				onmouseout="OLclearAJAX(); nd();">Haga CLICK par Ver la Imagen</a></td>
			<td width="2%"><a
				href="{$self}?id={$obj->id}&amp;accion=editarAttach&amp;subaccion=editar"><img
				class="ordenar" src="css-imgs/editar.png" alt="Editar Attach"
				title="Editar Attach" /></a></td>
			<td width="2%"><a
				href="{$self}?id={$obj->id}&amp;accion=editarAttach&amp;subaccion=borrar"><img
				class="ordenar" src="css-imgs/borrar.png" alt="Eliminar Attach"
				title="Eliminar Attach" /></a></td>
		</tr>
		{/foreach}

	</tbody>
</table>
</div>



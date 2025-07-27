<br />
<div class="lista">
<table class="lista" summary="{$titulo}" border="0">
	<tbody>
		<tr>
			{foreach key=k item=v from=$columna}
			<th>{$objeto->rotulo($k)}</th>
			{/foreach}
			<th colspan="2"></th>
		</tr>
		{foreach from=$listaObjetos item=obj} {if $obj->id != $objeto->id}
		<tr onmouseout="this.bgColor='Linen'"
			onmouseover="this.bgColor='Coral'">
			{include file="tipo-dato-listador.tpl"}
			<td width="2%"><a
				href="{$self}?id={$objet->id}&amp;accion=editar{$SUBOBJETO}&amp;comando=modificar{$OBJETO}&amp;zid={$obj->id}"><img
				class="ordenar" src="css-imgs/editar.png" alt="Editar {$SUBOBJETO}"
				title="Editar {$SUBOBJETO}" /></a></td>
			<td width="2%"><a
				href="{$self}?id={$objet->id}&amp;accion=editar{$SUBOBJETO}&amp;comando=eliminar{$OBJETO}&amp;zid={$obj->id}"><img
				class="ordenar" src="css-imgs/borrar.png"
				alt="Eliminar {$SUBOBJETO}" title="Eliminar {$SUBOBJETO}" /></a></td>
		</tr>
		{/if} {/foreach}
		<tr>
			<form action="{$self}" method="post">{foreach key=k item=v
			from=$columna} {if in_array($k,$CAMPOS) } {if
			$objeto->GetType($OBJETO,$k) == "tinyint"}
			<td><select name="{$k}" tabindex="1">
				{if $objeto->$k == 1}
				<option label="SI" selected="selected" value="1">SI</option>
				<option label="NO" value="0">NO</option>
				{else}
				<option label="SI" value="1">SI</option>
				<option label="NO" selected="selected" value="0">NO</option>
				{/if}
			</select></td>
			{else} {if $objeto->GetType($OBJETO,$k) == "char"}
			<td><select name="{$k}" tabindex="1">
				{foreach from=$tabla->valor($OBJETO,$k) item=tabl} {if $objeto->$k
				== $tabl->numero}
				<option label="{$tabl->nombre}" selected="selected"
					value="{$tabl->numero}">{$tabl->nombre}</option>
				{else}
				<option label="{$tabl->nombre}" value="{$tabl->numero}">{$tabl->nombre}</option>
				{/if} {/foreach}
			</select></td>
			{else} {if $objeto->GetType($OBJETO,$k) == "date"}
			<td><input size="10" tabindex="1" type="text" id="{$k}" name="{$k}"
				value="{$objeto->$k|date_format:" %d/%m/%Y"}" /> <a href=""
				id="trigger{$k}"><img class="calendario1" src="css-imgs/b_calendar.png"
				alt="Ver Calendario" title="Ver Calendario" /></a> {dhtml_calendar	inputField="{$k}" button="trigger{$k}"}</td>
			{else} {if $objeto->GetType($OBJETO,$k) == "longtext"}
			<td><textarea tabindex="1" name="{$k}" rows="5" cols="40">{$objeto->$k}</textarea></td>
			{else} {if $objeto->GetType($OBJETO,$k) == "blob" or
			$objeto->GetType($OBJETO,$k) == "longblob" }
			<td>Este campo no se puede visualizar</td>
			{else} {if $objeto->esForaneo($k)}
			<td><select name="{$k}" tabindex="1">
				{if $objeto->$k == 0}
				<option label="-- NADA --" selected="selected" value="0">-- NADA --</option>
				{else}
				<option label="-- NADA --" value="0">-- NADA --</option>
				{/if} {foreach from=$objeto->FindAll($objeto->esForaneo($k))
				item=rela} {if $objeto->$k == $rela->GET_campo($objeto->campoForaneo($k))}
				<option label="{$rela->leyenda()}" selected="selected"
					value="{$rela->GET_campo($objeto->campoForaneo($k))}">{$rela->leyenda()}</option>
				{else}
				<option label="{$rela->leyenda()}" value="{$rela->GET_campo($objeto->campoForaneo($k))}">{$rela->leyenda()}</option>
				{/if} {/foreach}
			</select></td>
			{else} {if $k =="id"}
			<td>{$objeto->$k}<input name="{$k}" type="hidden"
				value="{$objeto->$k}" /></td>
			{else}
			<td><input size="{$objeto->GetLen($OBJETO,$k)}" name="{$k}"
				tabindex="1" type="text" value="{$objeto->$k}" /></td>
			{/if} {/if} {/if} {/if} {/if} {/if} {/if} {else} <input type="hidden"
				name="{$k}" value="{$objeto->$k}" /> {/if} {/foreach}
			<td colspan="2"><input value="ok" tabindex="1" type="submit" /> <input
				type="hidden" name="accion" value="editar{$SUBOBJETO}" /> <input
				type="hidden" name="date_concurrency"
				value="{$objeto->date_concurrency}" /> <input type="hidden"
				name="id" value="{$objet->id}" /> <input type="hidden"
				name="comando" value="guardar{$OBJETO}" /> <input type="hidden"
				name="zid" value="{$objeto->id}" /></td>
			</form>
		</tr>

	</tbody>
</table>
</div>


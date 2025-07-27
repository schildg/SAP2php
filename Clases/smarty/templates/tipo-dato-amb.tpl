 {foreach key=k item=v from=$columna} {if in_array($k,$CAMPOS) }
<tr>
	<th>{$objeto->rotulo($k)}</th>
	{if $objeto->GetType($OBJETO,$k) == "tinyint"}
	<th><select name="{$k}" tabindex="1">
		{if $objeto->$k == 1}
		<option label="SI" selected="selected" value="1">SI</option>
		<option label="NO" value="0">NO</option>
		{else}
		<option label="SI" value="1">SI</option>
		<option label="NO" selected="selected" value="0">NO</option>
		{/if}
	</select></th>
	{else} {if $objeto->GetType($OBJETO,$k) == "char"}
	<th><select name="{$k}" tabindex="1">
		{foreach from=$tabla->valor($OBJETO,$k) item=tabl} {if $objeto->$k ==
		$tabl->numero}
		<option label="{$tabl->nombre}" selected="selected"
			value="{$tabl->numero}">{$tabl->nombre}</option>
		{else}
		<option label="{$tabl->nombre}" value="{$tabl->numero}">{$tabl->nombre}</option>
		{/if} {/foreach}
	</select></th>
	{else} {if $objeto->GetType($OBJETO,$k) == "date"}
	<th><input tabindex="1" type="text" id="{$k}" name="{$k}"
		value="{$objeto->$k|date_format:" %d/%m/%Y"}" /> <a href=""
		id="trigger{$k}"><img class="calendario" src="css-imgs/cal.png"
		alt="Ver Calendario" title="Ver Calendario" /></a> {dhtml_calendar	inputField="{$k}" button="trigger{$k}" }</th>
	{else} {if $objeto->GetType($OBJETO,$k) == "longtext" ||$objeto->GetType($OBJETO,$k) == "tinytext"}
	<th><textarea tabindex="1" name="{$k}" rows="5" cols="40">{$objeto->$k}</textarea></th>
	{else} {if $objeto->GetType($OBJETO,$k) == "blob" or
	$objeto->GetType($OBJETO,$k) == "longblob" } {if $Accion ==
	"altaEstablecimiento" or $Accion == "editarEstablecimiento"}
	<th><input type="file" name="{$k}" id="{$k}" /></th>
	{else}
	<th>Este campo no se puede visualizar</th>
	{/if} {else} {if $objeto->esForaneo($k)}
	<th><select name="{$k}" tabindex="1">
		{if $objeto->$k == ""}
		<option label="-- NADA --" selected="selected" value="">-- NADA --</option>
		{else}
		<option label="-- NADA --" value="">-- NADA --</option>
		{/if} {foreach from=$objeto->FindAll($objeto->esForaneo($k))
		item=rela} {if $objeto->$k == $rela->GET_campo($objeto->campoForaneo($k))}
		<option label="{$rela->leyenda()}" selected="selected"
			value="{$rela->GET_campo($objeto->campoForaneo($k))}">{$rela->leyenda()}</option>
		{else}
		<option label="{$rela->leyenda()}" value="{$rela->GET_campo($objeto->campoForaneo($k))}">{$rela->leyenda()}</option>
		{/if} {/foreach}
	</select></th>
	{else}
	<th><input size="{$objeto->GetLen($OBJETO,$k)}" name="{$k}"
		tabindex="1" type="text" value="{$objeto->$k}" {if $k==
		"id"} disabled="disabled" /><input name="{$k}" type="hidden"
		value="{$objeto->$k}" {/if}/></th>
	{/if} {/if} {/if} {/if} {/if} {/if}
</tr>
{else}
<input
	type="hidden" name="{$k}" value="{$objeto->$k}" />
{/if} {/foreach}

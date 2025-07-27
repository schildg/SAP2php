 {foreach key=k item=v from=$columna} {if $objeto->GetType($OBJETO,$k)
!= "timestamp"}
<tr>
	<th>{$objeto->rotulo($k)}</th>
	<th><input tabindex="1" name="sel-{$k}" type="checkbox"{if $sel[$k]} checked {/if}></th>
	{if $objeto->GetType($OBJETO,$k) == "tinyint"}
	<th><select name="filtro-{$k}" tabindex="1">
		{foreach from=$tabla->valor('FILTRO','BOOLEAN') item=tabl} {if
		$filtro[$k] == $tabl->noco}
		<option label="{$tabl->nombre}" selected="selected"
			value="{$tabl->noco}">{$tabl->nombre}</option>
		{else}
		<option label="{$tabl->nombre}" value="{$tabl->noco}">{$tabl->nombre}</option>
		{/if} {/foreach}
	</select></th>
	{else} {if $objeto->GetType($OBJETO,$k) == "date"}
	<th><select name="filtro-{$k}" tabindex="1">
		{foreach from=$tabla->valor('FILTRO','DATE') item=tabl} {if
		$filtro[$k] == $tabl->noco}
		<option label="{$tabl->nombre}" selected="selected"
			value="{$tabl->noco}">{$tabl->nombre}</option>
		{else}
		<option label="{$tabl->nombre}" value="{$tabl->noco}">{$tabl->nombre}</option>
		{/if} {/foreach}
	</select></th>
	{else} {if $objeto->GetType($OBJETO,$k) == "varchar"}
	<th><select name="filtro-{$k}" tabindex="1">
		{foreach from=$tabla->valor('FILTRO','STRING') item=tabl} {if
		$filtro[$k] == $tabl->noco}
		<option label="{$tabl->nombre}" selected="selected"
			value="{$tabl->noco}">{$tabl->nombre}</option>
		{else}
		<option label="{$tabl->nombre}" value="{$tabl->noco}">{$tabl->nombre}</option>
		{/if} {/foreach}
	</select></th>
	{else} {if $objeto->GetType($OBJETO,$k) == "int"}
	<th><select name="filtro-{$k}" tabindex="1">
		{foreach from=$tabla->valor('FILTRO','INTEGER') item=tabl} {if
		$filtro[$k] == $tabl->noco}
		<option label="{$tabl->nombre}" selected="selected"
			value="{$tabl->noco}">{$tabl->nombre}</option>
		{else}
		<option label="{$tabl->nombre}" value="{$tabl->noco}">{$tabl->nombre}</option>
		{/if} {/foreach}
	</select></th>
	{else} {if $objeto->GetType($OBJETO,$k) == "char"}
	<th><select name="filtro-{$k}" tabindex="1">
		{foreach from=$tabla->valor('FILTRO','BINARY') item=tabl} {if
		$filtro[$k] == $tabl->noco}
		<option label="{$tabl->nombre}" selected="selected"
			value="{$tabl->noco}">{$tabl->nombre}</option>
		{else}
		<option label="{$tabl->nombre}" value="{$tabl->noco}">{$tabl->nombre}</option>
		{/if} {/foreach}
	</select></th>
	{else}
	<th></th>
	{/if} {/if} {/if} {/if} {/if} {if $objeto->GetType($OBJETO,$k) ==
	"tinyint"}
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
	{else} {if $objeto->esForaneo($k)}
	<th><select name="{$k}" tabindex="1">
		{if $objeto->$k == 0}
		<option label="-- NADA --" selected="selected" value="0">-- NADA --</option>
		{else}
		<option label="-- NADA --" value="0">-- NADA --</option>
		{/if} {foreach from=$relacion->FindAll($objeto->esForaneo($k))
		item=rela} {if $objeto->$k == $rela->GET_campo($objeto->campoForaneo($k))}
		<option label="{$rela->leyenda()}" selected="selected"
			value="{$rela->GET_campo($objeto->campoForaneo($k))}">{$rela->leyenda()}</option>
		{else}
		<option label="{$rela->leyenda()}" value="{$rela->GET_campo($objeto->campoForaneo($k))}">{$rela->leyenda()}</option>
		{/if} {/foreach}
	</select></th>
	{else}
	<th><input size="{$objeto->GetLen($OBJETO,$k)}" name="{$k}"
		tabindex="1" type="text" value="{$objeto->$k}" /></th>
	{/if} {/if} {/if} {/if}
</tr>
{/if} {/foreach}

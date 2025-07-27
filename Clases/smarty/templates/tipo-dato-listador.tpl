 {foreach key=k item=v from=$columna} {if
$obj->GetType($OBJETO,$k)=="tinyint"}
<td>{if $obj->$k == 1} SI {else} NO {/if}</td>
{else} {if $obj->GetType($OBJETO,$k)=="char"}
<td>{$tabla->campo($OBJETO,$k,$obj->$k)}</td>
{else} {if $obj->GetType($OBJETO,$k)=="date"}
<td>{$obj->$k|date_format:"%d/%m/%Y"}</td>
{else} {if $obj->esForaneo($k)}
<td><a
	href="{$self}?id={$obj->buscoIdForaneo($k,$obj->$k)}&amp;accion=editar{$obj->esForaneo($k)}&amp;subaccion=editar">{$obj->leyendaDelIdListado($k,$obj->$k)}</a></td>
{else}
<td>{$obj->$k}</td>
{/if} {/if} {/if} {/if} {/foreach}

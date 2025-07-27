{if !$exportarPlanCal}

<form action="{$self}" method="post">
<fieldset><legend>Informaci&#243;n de la relacion {$OBJETO}</legend>
<table class="campo-amb" summary="{$titulo}" border="0">
	<tbody>
		{include file="tipo-dato-filtro.tpl"}
	</tbody>
</table>
</fieldset>
<p></p>
<input value="Buscar" tabindex="1" type="submit" />
<p></p>
<input type="hidden" name="accion" value="filtro{$SUBOBJETO}" /></form>
{/if}

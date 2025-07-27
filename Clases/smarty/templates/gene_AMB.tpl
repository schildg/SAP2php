
<table summary="{$titulo}" border="0">
	<tbody>
		<tr>
			{if $subaccion!="borrar"}
			<th>
			<h2>{$titulo}</h2>
			</th>
			{else}
			<th>
			<h2>{$titulo}</h2>
			</th>
			{/if} {if $objeto->id!=0}
			<td>
			<div id="contab-herramienta">{if
			$attach->tieneAttach($OBJETO,$objeto->id)} <a
				href="{$self}?objeto_id={$objeto->id}&amp;accion=VerAttach{$OBJETO}"><img
				border="none" height="160px" src="css-imgs/tiene_attach.png"
				alt="Tiene Attach" title="Tiene Attach" /></a> {/if} <a
				href="{$self}?objeto_id={$objeto->id}&amp;accion=Attach{$OBJETO}"><img
				class="iconos" src="css-imgs/attach.png"
				alt="Atachar Objetos a {$titulo_objeto}"
				title="Atachar Objetos a {$titulo_objeto}" />Atachar Objetos</a> <a
				href="{$self|regex_replace:" /index.php/":""}manPDF.php?id={$objeto->id}&amp;accion=doc{$subobjeto}PDF"
			TARGET='_blank'><img class="iconos" src="css-imgs/pdf.png"
				alt="Generar PDF del Documento" title="Generar PDF del Documento" />Generar
			PDF</a> {if $verHistoria == 0} <a
				href="{$self}?id={$objeto->id}&amp;accion={$Accion}&amp;subaccion={$subaccion}&amp;verHistoria=1"><img
				class="iconos" src="css-imgs/verhist.png"
				alt="Ver Historial de Movimientos"
				title="Ver Historial de Movimientos" />Ver Historial</a> {else} <a
				href="{$self}?id={$objeto->id}&amp;accion={$Accion}&amp;subaccion={$subaccion}&amp;verHistoria=0"><img
				class="iconos" src="css-imgs/noverhist.png"
				alt="Ocultar Historial de Movimientos"
				title="Ocultar Historial de Movimientos" />Ocultar Historial</a>
			{/if}</div>
			</td>
			{/if}
		</tr>
	</tbody>
</table>

<form action="{$self}" method="post" enctype="multipart/form-data">
<fieldset>
<p></p>
<legend>Informaci&#243;n de {$titulo_objeto}</legend>
<table class="campo-amb" summary="Dato de {$titulo_objeto}" border="0">
	<tbody>
		{include file="tipo-dato-amb.tpl"}
	</tbody>
</table>
</fieldset>
<p></p>
{if $subaccion!="borrar"} <input value="Aceptar" tabindex="1"
	type="submit" /><input type="reset" tabindex="1" value="Cancelar" />
<p></p>
<input type="hidden" name="accion" value="{$subobjeto}" /> {else} <input
	value="Eliminar" tabindex="1" type="submit" /><input type="reset"
	tabindex="1" value="Cancelar" />
<p></p>
<input type="hidden" name="accion" value="borrar{$subobjeto}" /> {/if}</form>

{if $verHistoria == 1 } {include file="historia.tpl"} {/if}

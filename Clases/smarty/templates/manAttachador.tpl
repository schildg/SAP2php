
<table summary="Datos de la Accion" border="0">
	<tbody>
		<tr>
			<th>
			<h2>Cargador de Attach a Documentos</h2>
			</th>
		</tr>
	</tbody>
</table>

<form action="{$self}" method="post" enctype="multipart/form-data">
<fieldset>
<p></p>
<legend>Informaci&#243;n del Attach</legend>
<table class="campo-amb" summary="Datos del Attach" border="0">
	<tbody>
		<tr>
			<td>Descripcion del attach</td>
			<td><input type="text" name="nombre" id="nombre" /></td>
		</tr>
		<tr>
			<td>Objeto a Attachar</td>
			<td><input type="file" name="attach" id="attach" /></td>
		</tr>
		<tr>
			<td><input type="submit" name="enviar" id="enviar" value="Guardar" /></td>
		</tr>
		<tr>
			<input type="hidden" name="objeto" value="{$objeto}" />
		</tr>
		<tr>
			<input type="hidden" name="objeto_id" value="{$objeto_id}" />
		</tr>
		<tr>
			<input type="hidden" name="accion" value="AttachObjeto" />
		</tr>
	</tbody>
</table>
</fieldset>
</form>


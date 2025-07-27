
<table summary="Datos del Excel" border="0">
	<tbody>
		<tr>
			<th>
			<h2>{$titulo_cargador_excel}</h2>
			</th>
		</tr>
	</tbody>
</table>

<form action="{$self}" method="post" enctype="multipart/form-data">
<fieldset>
<p></p>
<legend>Informaci&#243;n de la Planilla de Excel</legend>
<table class="campo-amb" summary="Datos de la Planilla de Excel" border="0">
	<tbody>
		<tr>
			<td>Planilla de Excel</td>
			<td><input type="file" name="Planilla_excel" id="Planilla_excel" accept="application/vnd.ms-excel"/></td>
		</tr>
		<tr>
			<td><input type="submit" name="enviar" id="enviar" value="Procesar" /></td>
		</tr>
		<tr>
			<input type="hidden" name="objeto" value="{$objeto}" />
		</tr>
		<tr>
			<input type="hidden" name="objeto_id" value="{$objeto_id}" />
		</tr>
		<tr>
			<input type="hidden" name="upload" value="Procesar_Carga_de_Excel" />
		</tr>
		<tr>
			<input type="hidden" name="accion" value="{$accion}" />
		</tr>
	</tbody>
</table>
</fieldset>
</form>


<h1>Detalle del Error SAP</h1>



<div class="lista">
<table class="lista" summary="Detalle del Error SAP" border="0">
	<tbody>
		<tr>
			<th>estado</th>
			<th>codigo</th>
			<th>numero</th>
			<th>numero_sap</th>
			<th>id_objeto_sap</th>
			<th>rfc</th>
			<th>type</th>
			<th>number</th>
			<th>message</th>
			<th>AUFNR</th>
			<th>RSPOS</th>
			<th>MATNR</th>
			<th>WERKS</th>
			<th>CHARG</th>
			<th>LGORT</th>
			<th>SOBKZ</th>
			<th>VORNR</th>
			<th>MENGE</th>
			<th>MEINS</th>
			<th>ERFMG</th>
			<th>ERFME</th>
			<th>VHILM</th>
			<th>EXBNR</th>
			<th>EXIDV</th>
			<th>EXIDV_OB</th>
			<th>EXPLZ</th>
			<th>ERNAM</th>
			<th>ERDAT</th>
			<th>ERZET</th>
			<th>TWFLG</th>
			<th>BERTS</th>
			<th colspan="1"></th>
			
		</tr>
		{foreach from=$consulta item=cons}
		<tr onmouseout="this.bgColor='Linen'"
			onmouseover="this.bgColor='Coral'">
			<td>{$cons["estado"]}</td>
			<td>{$cons["codigo"]}</td>
			<td>{$cons["numero"]}</td>
			<td>{$cons["numero_sap"]}</td>
			<td>{$cons["id_objeto_sap"]}</td>
			<td>{$cons["rfc"]}</td>
			<td>{$cons["type"]}</td>
			<td>{$cons["number"]}</td>
			<td>{$cons["message"]}</td>
			<td>{$cons["AUFNR"]}</td>
			<td>{$cons["RSPOS"]}</td>
			<td>{$cons["MATNR"]}</td>
			<td>{$cons["WERKS"]}</td>
			<td>{$cons["CHARG"]}</td>
			<td>{$cons["LGORT"]}</td>
			<td>{$cons["SOBKZ"]}</td>
			<td>{$cons["VORNR"]}</td>
			<td>{$cons["MENGE"]}</td>
			<td>{$cons["MEINS"]}</td>
			<td>{$cons["ERFMG"]}</td>
			<td>{$cons["ERFME"]}</td>
			<td>{$cons["VHILM"]}</td>
			<td>{$cons["EXBNR"]}</td>
			<td>{$cons["EXIDV"]}</td>
			<td>{$cons["EXIDV_OB"]}</td>
			<td>{$cons["EXPLZ"]}</td>
			<td>{$cons["ERNAM"]}</td>
			<td>{$cons["ERDAT"]}</td>
			<td>{$cons["ERZET"]}</td>
			<td>{$cons["TWFLG"]}</td>
			<td>{$cons["BERTS"]}</td>
		</tr>
		{/foreach}
	</tbody>
</table>
</div>


<?php /* Smarty version Smarty-3.1.18, created on 2015-04-30 08:29:55
         compiled from "C:\Sistema_php_anita\Portal\SAP2php\Clases\smarty\templates\manAttachador.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2174355421233886728-54873639%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fd7d5adec0749b3228935e481c6632b1732254dd' => 
    array (
      0 => 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\templates\\manAttachador.tpl',
      1 => 1426529020,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2174355421233886728-54873639',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'self' => 0,
    'objeto' => 0,
    'objeto_id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_554212339575f7_98088566',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_554212339575f7_98088566')) {function content_554212339575f7_98088566($_smarty_tpl) {?>
<table summary="Datos de la Accion" border="0">
	<tbody>
		<tr>
			<th>
			<h2>Cargador de Attach a Documentos</h2>
			</th>
		</tr>
	</tbody>
</table>

<form action="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
" method="post" enctype="multipart/form-data">
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
			<input type="hidden" name="objeto" value="<?php echo $_smarty_tpl->tpl_vars['objeto']->value;?>
" />
		</tr>
		<tr>
			<input type="hidden" name="objeto_id" value="<?php echo $_smarty_tpl->tpl_vars['objeto_id']->value;?>
" />
		</tr>
		<tr>
			<input type="hidden" name="accion" value="AttachObjeto" />
		</tr>
	</tbody>
</table>
</fieldset>
</form>

<?php }} ?>

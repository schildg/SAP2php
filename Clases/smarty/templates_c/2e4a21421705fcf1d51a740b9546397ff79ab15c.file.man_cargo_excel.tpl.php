<?php /* Smarty version Smarty-3.1.18, created on 2015-05-04 13:47:04
         compiled from "C:\Sistema_php_anita\Portal\SAP2php\Clases\smarty\templates\man_cargo_excel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1098555422368c95a45-98919870%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2e4a21421705fcf1d51a740b9546397ff79ab15c' => 
    array (
      0 => 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\templates\\man_cargo_excel.tpl',
      1 => 1430757994,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1098555422368c95a45-98919870',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_55422368d3af15_69710786',
  'variables' => 
  array (
    'titulo_cargador_excel' => 0,
    'self' => 0,
    'objeto' => 0,
    'objeto_id' => 0,
    'accion' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55422368d3af15_69710786')) {function content_55422368d3af15_69710786($_smarty_tpl) {?>
<table summary="Datos del Excel" border="0">
	<tbody>
		<tr>
			<th>
			<h2><?php echo $_smarty_tpl->tpl_vars['titulo_cargador_excel']->value;?>
</h2>
			</th>
		</tr>
	</tbody>
</table>

<form action="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
" method="post" enctype="multipart/form-data">
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
			<input type="hidden" name="objeto" value="<?php echo $_smarty_tpl->tpl_vars['objeto']->value;?>
" />
		</tr>
		<tr>
			<input type="hidden" name="objeto_id" value="<?php echo $_smarty_tpl->tpl_vars['objeto_id']->value;?>
" />
		</tr>
		<tr>
			<input type="hidden" name="upload" value="Procesar_Carga_de_Excel" />
		</tr>
		<tr>
			<input type="hidden" name="accion" value="<?php echo $_smarty_tpl->tpl_vars['accion']->value;?>
" />
		</tr>
	</tbody>
</table>
</fieldset>
</form>

<?php }} ?>

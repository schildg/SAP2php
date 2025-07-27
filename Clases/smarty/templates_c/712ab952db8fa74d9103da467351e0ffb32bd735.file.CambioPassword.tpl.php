<?php /* Smarty version Smarty-3.1.18, created on 2014-08-28 11:06:28
         compiled from "C:\DATOS-DE-USUARIOS\workspace\SAP2php\Clases\smarty\templates\CambioPassword.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1175653ff376427ffb2-88800779%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '712ab952db8fa74d9103da467351e0ffb32bd735' => 
    array (
      0 => 'C:\\DATOS-DE-USUARIOS\\workspace\\SAP2php\\Clases\\smarty\\templates\\CambioPassword.tpl',
      1 => 1403708930,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1175653ff376427ffb2-88800779',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'self' => 0,
    'usuario' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53ff37643c7cb3_39843229',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ff37643c7cb3_39843229')) {function content_53ff37643c7cb3_39843229($_smarty_tpl) {?>
<form action="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
" method="post">
<fieldset><legend align="center">Cambio de Password</legend>
<table class="campo-amb" summary="Cambio de Password" border="0"
	align="center">
	<tbody>
		<tr>
			<th>Usuario:</th>
			<th><input name="user" tabindex="1" type="text"
				value="<?php echo $_smarty_tpl->tpl_vars['usuario']->value->login;?>
" disabled="disabled" /></th>
			<th rowspan="4"><img width="128px" height="128px"
				src="css-imgs/locked.png" alt="Cambiar Password" /></th>
		</tr>
		<tr>
			<th>Password Anterior:</th>
			<th><input type="password" name="passAnt" value="" tabindex="2" /></th>
		</tr>
		<tr>
			<th>Password Nuevo:</th>
			<th><input type="password" name="pass1" value="" tabindex="3" /></th>
		</tr>
		<tr>
			<th>Confirme el Password:</th>
			<th><input type="password" name="pass2" value="" tabindex="4" /></th>
		</tr>
		<tr>
			<th><input type="submit" value="Enviar" /><input type="hidden"
				name="accion" value="cambiarPassword" /></th>
		</tr>
	</tbody>
</table>
</fieldset>
</form>
<?php }} ?>

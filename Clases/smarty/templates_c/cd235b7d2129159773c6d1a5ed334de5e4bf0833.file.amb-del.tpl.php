<?php /* Smarty version Smarty-3.1.18, created on 2014-09-24 08:38:23
         compiled from "C:\DATOS-DE-USUARIOS\workspace\SAP2php\Clases\smarty\templates\amb-del.tpl" */ ?>
<?php /*%%SmartyHeaderCode:159225422ad2faf7591-70225100%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cd235b7d2129159773c6d1a5ed334de5e4bf0833' => 
    array (
      0 => 'C:\\DATOS-DE-USUARIOS\\workspace\\SAP2php\\Clases\\smarty\\templates\\amb-del.tpl',
      1 => 1404734958,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '159225422ad2faf7591-70225100',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_anteultima' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5422ad2fc87bc0_56427994',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5422ad2fc87bc0_56427994')) {function content_5422ad2fc87bc0_56427994($_smarty_tpl) {?>
<form action="<?php echo $_smarty_tpl->tpl_vars['url_anteultima']->value;?>
" method="post">
<table summary="informacion de sesion" border="0" align="center">
	<tbody>
		<tr>
			<th><img src="css-imgs/ok.png" /></th>
			<th>
			<h1>El registro ha sido eliminado exitosamente</h1>
			</th>
		</tr>
		<tr><th></th><th><input value="Continuar" tabindex="1"	type="submit" /></th></tr>
	</tbody>
</table>
</form>
<?php }} ?>

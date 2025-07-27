<?php /* Smarty version Smarty-3.1.18, created on 2014-08-27 12:28:16
         compiled from "C:\DATOS-DE-USUARIOS\workspace\SAP2php\Clases\smarty\templates\amb-ok.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2515053fdf910affff6-63814134%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4c028f7092aed12b8b16150eedb0600f1986e367' => 
    array (
      0 => 'C:\\DATOS-DE-USUARIOS\\workspace\\SAP2php\\Clases\\smarty\\templates\\amb-ok.tpl',
      1 => 1404735120,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2515053fdf910affff6-63814134',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_anteultima' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53fdf910c5b3a5_54265432',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53fdf910c5b3a5_54265432')) {function content_53fdf910c5b3a5_54265432($_smarty_tpl) {?>
<form action="<?php echo $_smarty_tpl->tpl_vars['url_anteultima']->value;?>
" method="post">
<table summary="informacion de sesion" border="0" align="center">
	<tbody>
		<tr>
			<th><img src="css-imgs/ok.png" /></th>
			<th>
			<h1>El registro ha sido cargado exitosamente</h1>
			</th>
		</tr>
		<tr><th></th><th><input value="Continuar" tabindex="1"	type="submit" /></th></tr>
	</tbody>
</table>
</form>
<?php }} ?>

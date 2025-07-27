<?php /* Smarty version Smarty-3.1.18, created on 2015-05-04 13:59:18
         compiled from "C:\Sistema_php_anita\Portal\SAP2php\Clases\smarty\templates\msg_error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2065155479ffd2193b4-58882498%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '415791c07c527750903fbe62487d3b41ca80db42' => 
    array (
      0 => 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\templates\\msg_error.tpl',
      1 => 1430758744,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2065155479ffd2193b4-58882498',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_55479ffd2a3940_48762003',
  'variables' => 
  array (
    'url_anteultima' => 0,
    'msg_error' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55479ffd2a3940_48762003')) {function content_55479ffd2a3940_48762003($_smarty_tpl) {?>
<form action="<?php echo $_smarty_tpl->tpl_vars['url_anteultima']->value;?>
" method="post">
<table summary="informacion de sesion" border="0" align="center">
	<tbody>
		<tr>
			<th><img class="iconos" src="css-imgs/error_sql.png" /></th>
			<th>
			<h2><?php echo $_smarty_tpl->tpl_vars['msg_error']->value;?>
</h2>
			</th>
		</tr>
		<tr><th></th><th><input value="Continuar" tabindex="1"	type="submit" /></th></tr>
	</tbody>
</table>
</form>
<?php }} ?>

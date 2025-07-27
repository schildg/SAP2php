<?php /* Smarty version Smarty-3.1.18, created on 2016-09-01 19:12:46
         compiled from "C:\Sistema_php_anita\Portal\SAP2php\Clases\smarty\templates\amb-del.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2476654b69e9e1959f5-15839356%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7f3792c767298b66eeb9d8fad7a221dcaa872707' => 
    array (
      0 => 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\templates\\amb-del.tpl',
      1 => 1426529019,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2476654b69e9e1959f5-15839356',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54b69e9e226d85_41672536',
  'variables' => 
  array (
    'url_anteultima' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54b69e9e226d85_41672536')) {function content_54b69e9e226d85_41672536($_smarty_tpl) {?>
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

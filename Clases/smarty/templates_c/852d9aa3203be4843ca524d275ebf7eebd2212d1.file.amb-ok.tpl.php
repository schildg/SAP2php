<?php /* Smarty version Smarty-3.1.18, created on 2015-03-18 10:38:42
         compiled from "C:\Sistema_php_anita\Portal\SAP2php\Clases\smarty\templates\amb-ok.tpl" */ ?>
<?php /*%%SmartyHeaderCode:126585499769fc4dd82-13778022%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '852d9aa3203be4843ca524d275ebf7eebd2212d1' => 
    array (
      0 => 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\templates\\amb-ok.tpl',
      1 => 1426529019,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '126585499769fc4dd82-13778022',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5499769fce2757_66789098',
  'variables' => 
  array (
    'url_anteultima' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5499769fce2757_66789098')) {function content_5499769fce2757_66789098($_smarty_tpl) {?>
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

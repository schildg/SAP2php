<?php /* Smarty version Smarty-3.1.18, created on 2015-03-19 16:18:04
         compiled from "C:\Sistema_php_anita\Portal\SAP2php\Clases\smarty\templates\tipo-dato-listador.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1515054986113b4ba72-95461544%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a1048ce50d3046cadcd9257722e047aa3007d6a4' => 
    array (
      0 => 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\templates\\tipo-dato-listador.tpl',
      1 => 1426529020,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1515054986113b4ba72-95461544',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54986113ce65c4_77505795',
  'variables' => 
  array (
    'columna' => 0,
    'OBJETO' => 0,
    'k' => 0,
    'obj' => 0,
    'tabla' => 0,
    'self' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54986113ce65c4_77505795')) {function content_54986113ce65c4_77505795($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\plugins\\modifier.date_format.php';
?> <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['columna']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?> <?php if ($_smarty_tpl->tpl_vars['obj']->value->GetType($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['k']->value)=="tinyint") {?>
<td><?php if ($_smarty_tpl->tpl_vars['obj']->value->{$_smarty_tpl->tpl_vars['k']->value}==1) {?> SI <?php } else { ?> NO <?php }?></td>
<?php } else { ?> <?php if ($_smarty_tpl->tpl_vars['obj']->value->GetType($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['k']->value)=="char") {?>
<td><?php echo $_smarty_tpl->tpl_vars['tabla']->value->campo($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['k']->value,$_smarty_tpl->tpl_vars['obj']->value->{$_smarty_tpl->tpl_vars['k']->value});?>
</td>
<?php } else { ?> <?php if ($_smarty_tpl->tpl_vars['obj']->value->GetType($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['k']->value)=="date") {?>
<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['obj']->value->{$_smarty_tpl->tpl_vars['k']->value},"%d/%m/%Y");?>
</td>
<?php } else { ?> <?php if ($_smarty_tpl->tpl_vars['obj']->value->esForaneo($_smarty_tpl->tpl_vars['k']->value)) {?>
<td><a
	href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?id=<?php echo $_smarty_tpl->tpl_vars['obj']->value->buscoIdForaneo($_smarty_tpl->tpl_vars['k']->value,$_smarty_tpl->tpl_vars['obj']->value->{$_smarty_tpl->tpl_vars['k']->value});?>
&amp;accion=editar<?php echo $_smarty_tpl->tpl_vars['obj']->value->esForaneo($_smarty_tpl->tpl_vars['k']->value);?>
&amp;subaccion=editar"><?php echo $_smarty_tpl->tpl_vars['obj']->value->leyendaDelIdListado($_smarty_tpl->tpl_vars['k']->value,$_smarty_tpl->tpl_vars['obj']->value->{$_smarty_tpl->tpl_vars['k']->value});?>
</a></td>
<?php } else { ?>
<td><?php echo $_smarty_tpl->tpl_vars['obj']->value->{$_smarty_tpl->tpl_vars['k']->value};?>
</td>
<?php }?> <?php }?> <?php }?> <?php }?> <?php } ?>
<?php }} ?>

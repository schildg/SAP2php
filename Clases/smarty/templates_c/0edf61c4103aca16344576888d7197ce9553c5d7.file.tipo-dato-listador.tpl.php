<?php /* Smarty version Smarty-3.1.18, created on 2014-08-26 09:40:27
         compiled from "C:\DATOS-DE-USUARIOS\workspace\SAP2php\Clases\smarty\templates\tipo-dato-listador.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2258153fc803bbc1ab7-45332020%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0edf61c4103aca16344576888d7197ce9553c5d7' => 
    array (
      0 => 'C:\\DATOS-DE-USUARIOS\\workspace\\SAP2php\\Clases\\smarty\\templates\\tipo-dato-listador.tpl',
      1 => 1404305269,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2258153fc803bbc1ab7-45332020',
  'function' => 
  array (
  ),
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
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53fc803bcdda19_91410152',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53fc803bcdda19_91410152')) {function content_53fc803bcdda19_91410152($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\DATOS-DE-USUARIOS\\workspace\\SAP2php\\Clases\\smarty\\plugins\\modifier.date_format.php';
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

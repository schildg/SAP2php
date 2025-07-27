<?php /* Smarty version Smarty-3.1.18, created on 2015-03-16 15:59:00
         compiled from "C:\Sistema_php_anita\Portal\SAP2php\Clases\smarty\templates\gene_AMB.tpl" */ ?>
<?php /*%%SmartyHeaderCode:269585499511a0eeef8-12575911%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0dbcf9edb35e6874e1f1a268cc6013e2821d701c' => 
    array (
      0 => 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\templates\\gene_AMB.tpl',
      1 => 1426529020,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '269585499511a0eeef8-12575911',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5499511a39c796_73232367',
  'variables' => 
  array (
    'titulo' => 0,
    'subaccion' => 0,
    'objeto' => 0,
    'OBJETO' => 0,
    'attach' => 0,
    'self' => 0,
    'titulo_objeto' => 0,
    'subobjeto' => 0,
    'verHistoria' => 0,
    'Accion' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5499511a39c796_73232367')) {function content_5499511a39c796_73232367($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_regex_replace')) include 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\plugins\\modifier.regex_replace.php';
?>
<table summary="<?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
" border="0">
	<tbody>
		<tr>
			<?php if ($_smarty_tpl->tpl_vars['subaccion']->value!="borrar") {?>
			<th>
			<h2><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</h2>
			</th>
			<?php } else { ?>
			<th>
			<h2><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</h2>
			</th>
			<?php }?> <?php if ($_smarty_tpl->tpl_vars['objeto']->value->id!=0) {?>
			<td>
			<div id="contab-herramienta"><?php if ($_smarty_tpl->tpl_vars['attach']->value->tieneAttach($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['objeto']->value->id)) {?> <a
				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?objeto_id=<?php echo $_smarty_tpl->tpl_vars['objeto']->value->id;?>
&amp;accion=VerAttach<?php echo $_smarty_tpl->tpl_vars['OBJETO']->value;?>
"><img
				border="none" height="160px" src="css-imgs/tiene_attach.png"
				alt="Tiene Attach" title="Tiene Attach" /></a> <?php }?> <a
				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?objeto_id=<?php echo $_smarty_tpl->tpl_vars['objeto']->value->id;?>
&amp;accion=Attach<?php echo $_smarty_tpl->tpl_vars['OBJETO']->value;?>
"><img
				class="iconos" src="css-imgs/attach.png"
				alt="Atachar Objetos a <?php echo $_smarty_tpl->tpl_vars['titulo_objeto']->value;?>
"
				title="Atachar Objetos a <?php echo $_smarty_tpl->tpl_vars['titulo_objeto']->value;?>
" />Atachar Objetos</a> <a
				href="<?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['self']->value," /index.php/",'');?>
manPDF.php?id=<?php echo $_smarty_tpl->tpl_vars['objeto']->value->id;?>
&amp;accion=doc<?php echo $_smarty_tpl->tpl_vars['subobjeto']->value;?>
PDF"
			TARGET='_blank'><img class="iconos" src="css-imgs/pdf.png"
				alt="Generar PDF del Documento" title="Generar PDF del Documento" />Generar
			PDF</a> <?php if ($_smarty_tpl->tpl_vars['verHistoria']->value==0) {?> <a
				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?id=<?php echo $_smarty_tpl->tpl_vars['objeto']->value->id;?>
&amp;accion=<?php echo $_smarty_tpl->tpl_vars['Accion']->value;?>
&amp;subaccion=<?php echo $_smarty_tpl->tpl_vars['subaccion']->value;?>
&amp;verHistoria=1"><img
				class="iconos" src="css-imgs/verhist.png"
				alt="Ver Historial de Movimientos"
				title="Ver Historial de Movimientos" />Ver Historial</a> <?php } else { ?> <a
				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?id=<?php echo $_smarty_tpl->tpl_vars['objeto']->value->id;?>
&amp;accion=<?php echo $_smarty_tpl->tpl_vars['Accion']->value;?>
&amp;subaccion=<?php echo $_smarty_tpl->tpl_vars['subaccion']->value;?>
&amp;verHistoria=0"><img
				class="iconos" src="css-imgs/noverhist.png"
				alt="Ocultar Historial de Movimientos"
				title="Ocultar Historial de Movimientos" />Ocultar Historial</a>
			<?php }?></div>
			</td>
			<?php }?>
		</tr>
	</tbody>
</table>

<form action="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
" method="post" enctype="multipart/form-data">
<fieldset>
<p></p>
<legend>Informaci&#243;n de <?php echo $_smarty_tpl->tpl_vars['titulo_objeto']->value;?>
</legend>
<table class="campo-amb" summary="Dato de <?php echo $_smarty_tpl->tpl_vars['titulo_objeto']->value;?>
" border="0">
	<tbody>
		<?php echo $_smarty_tpl->getSubTemplate ("tipo-dato-amb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	</tbody>
</table>
</fieldset>
<p></p>
<?php if ($_smarty_tpl->tpl_vars['subaccion']->value!="borrar") {?> <input value="Aceptar" tabindex="1"
	type="submit" /><input type="reset" tabindex="1" value="Cancelar" />
<p></p>
<input type="hidden" name="accion" value="<?php echo $_smarty_tpl->tpl_vars['subobjeto']->value;?>
" /> <?php } else { ?> <input
	value="Eliminar" tabindex="1" type="submit" /><input type="reset"
	tabindex="1" value="Cancelar" />
<p></p>
<input type="hidden" name="accion" value="borrar<?php echo $_smarty_tpl->tpl_vars['subobjeto']->value;?>
" /> <?php }?></form>

<?php if ($_smarty_tpl->tpl_vars['verHistoria']->value==1) {?> <?php echo $_smarty_tpl->getSubTemplate ("historia.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
 <?php }?>
<?php }} ?>

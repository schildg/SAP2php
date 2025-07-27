<?php /* Smarty version Smarty-3.1.18, created on 2015-03-18 14:11:51
         compiled from "C:\Sistema_php_anita\Portal\SAP2php\Clases\smarty\templates\detalleErrorSAP.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1913654bff1016c9648-10141076%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f6e32f727d750fa4c3ba98d31b63c8ac6ef7f9e' => 
    array (
      0 => 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\templates\\detalleErrorSAP.tpl',
      1 => 1426529019,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1913654bff1016c9648-10141076',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54bff101b22530_37768344',
  'variables' => 
  array (
    'consulta' => 0,
    'cons' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54bff101b22530_37768344')) {function content_54bff101b22530_37768344($_smarty_tpl) {?><h1>Detalle del Error SAP</h1>



<div class="lista">
<table class="lista" summary="Detalle del Error SAP" border="0">
	<tbody>
		<tr>
			<th>estado</th>
			<th>codigo</th>
			<th>numero</th>
			<th>numero_sap</th>
			<th>id_objeto_sap</th>
			<th>rfc</th>
			<th>type</th>
			<th>number</th>
			<th>message</th>
			<th>AUFNR</th>
			<th>RSPOS</th>
			<th>MATNR</th>
			<th>WERKS</th>
			<th>CHARG</th>
			<th>LGORT</th>
			<th>SOBKZ</th>
			<th>VORNR</th>
			<th>MENGE</th>
			<th>MEINS</th>
			<th>ERFMG</th>
			<th>ERFME</th>
			<th>VHILM</th>
			<th>EXBNR</th>
			<th>EXIDV</th>
			<th>EXIDV_OB</th>
			<th>EXPLZ</th>
			<th>ERNAM</th>
			<th>ERDAT</th>
			<th>ERZET</th>
			<th>TWFLG</th>
			<th>BERTS</th>
			<th colspan="1"></th>
			
		</tr>
		<?php  $_smarty_tpl->tpl_vars['cons'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cons']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['consulta']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cons']->key => $_smarty_tpl->tpl_vars['cons']->value) {
$_smarty_tpl->tpl_vars['cons']->_loop = true;
?>
		<tr onmouseout="this.bgColor='Linen'"
			onmouseover="this.bgColor='Coral'">
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["estado"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["codigo"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["numero"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["numero_sap"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["id_objeto_sap"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["rfc"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["type"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["number"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["message"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["AUFNR"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["RSPOS"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["MATNR"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["WERKS"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["CHARG"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["LGORT"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["SOBKZ"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["VORNR"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["MENGE"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["MEINS"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["ERFMG"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["ERFME"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["VHILM"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["EXBNR"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["EXIDV"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["EXIDV_OB"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["EXPLZ"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["ERNAM"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["ERDAT"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["ERZET"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["TWFLG"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["BERTS"];?>
</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>

<?php }} ?>

<?php /* Smarty version 2.6.16, created on 2008-08-07 11:14:45
         compiled from gallery:themes/gecko/templates/admin.tpl */ ?>
<table class="gcBackground3" width="820" cellspacing="0" cellpadding="0" align="center">
<tr valign="top">
<td>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "gallery:".($this->_tpl_vars['theme']['adminTemplate']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</td>
</tr>
</table>
<?php if (! empty ( $this->_tpl_vars['theme']['params']['sidebarBlocks'] )): ?>
<?php echo $this->_reg_objects['g'][0]->theme(array('include' => "sidebar.tpl"), $this);?>

<?php endif; ?>
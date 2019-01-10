<?php /* Smarty version 2.6.16, created on 2008-08-07 11:06:29
         compiled from gallery:themes/gecko/templates/sidebar.tpl */ ?>
<div id="sidebar" class="gcPopupBackground" style="position:absolute; left:-190px; top:<?php echo $this->_tpl_vars['theme']['params']['sidebarTop']; ?>
px; padding:1px;">
<table cellspacing="0" cellpadding="0">
<tr>
<td align="left" style="padding-left:5px;">
<h2>Menu</h2>
</td>
<td align="right" style="padding-right:2px;">
<div class="buttonHideSidebar"><a href="javascript: slideOut('sidebar')" title="Close"></a></div>
</td>
</tr>
<tr>
<td colspan="2" class="gcBackground4" style="padding-bottom:5px">
<div id="gsSidebar" class="gcBorder3">
<?php $_from = $this->_tpl_vars['theme']['params']['sidebarBlocks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['block']):
?>
<?php echo $this->_reg_objects['g'][0]->block(array('type' => $this->_tpl_vars['block']['0'],'params' => $this->_tpl_vars['block']['1'],'class' => 'gbBlock'), $this);?>

<?php endforeach; endif; unset($_from); ?>
<?php echo $this->_reg_objects['g'][0]->block(array('type' => "core.NavigationLinks",'class' => 'gbBlock'), $this);?>

</div>
</td>
</tr>
</table>
</div>
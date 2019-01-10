<?php /* Smarty version 2.6.16, created on 2008-08-07 11:06:41
         compiled from gallery:themes/gecko/templates/navigatorMicroThumbs.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'gallery:themes/gecko/templates/navigatorMicroThumbs.tpl', 7, false),)), $this); ?>
<?php echo $this->_reg_objects['g'][0]->callback(array('type' => "core.LoadPeers",'item' => ((is_array($_tmp=@$this->_tpl_vars['item'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['theme']['item']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['theme']['item'])),'windowSize' => ((is_array($_tmp=@$this->_tpl_vars['windowSize'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['theme']['params']['maxMicroThumbs']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['theme']['params']['maxMicroThumbs'])),'addEnds' => false,'loadThumbnails' => true), $this);?>

<?php $this->assign('data', $this->_tpl_vars['block']['core']['LoadPeers']); ?>
<?php if (! empty ( $this->_tpl_vars['data']['peers'] )): ?>
<div>
<?php $this->assign('lastIndex', 0); ?>
<?php $this->assign('columnIndex', 0); ?>
<table cellpadding="0" cellspacing="9" class="gcBackground5">
<tr>
<?php $_from = $this->_tpl_vars['data']['peers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['peer']):
?>
<?php $this->assign('title', ((is_array($_tmp=@$this->_tpl_vars['peer']['title'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['peer']['pathComponent']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['peer']['pathComponent']))); ?>
<?php if (( $this->_tpl_vars['columnIndex'] == 11 )): ?>
</tr>
<tr>
<?php $this->assign('columnIndex', 0); ?>
<?php endif; ?>
<?php if (( $this->_tpl_vars['peer']['peerIndex'] == $this->_tpl_vars['data']['thisPeerIndex'] )): ?>
<td id="microThumbActive" align="center" width="45" height="40">
<div class="gcBorder4">
<div class="gbNavigatorMicroThums2">
<?php echo $this->_reg_objects['g'][0]->image(array('item' => $this->_tpl_vars['peer'],'image' => $this->_tpl_vars['peer']['thumbnail'],'maxSize' => 40,'title' => ($this->_tpl_vars['title'])), $this);?>

</div>
</div>
</td>
<?php else: ?>
<td id="microThumbInactive" align="center" width="45" height="40">
<div class="gcBorder4">
<div class="gbNavigatorMicroThums2">
<a href="<?php echo $this->_reg_objects['g'][0]->url(array('arg1' => "view=core.ShowItem",'arg2' => "itemId=".($this->_tpl_vars['peer']['id'])), $this);?>
">
<?php echo $this->_reg_objects['g'][0]->image(array('item' => $this->_tpl_vars['peer'],'image' => $this->_tpl_vars['peer']['thumbnail'],'maxSize' => 40,'title' => ($this->_tpl_vars['title'])), $this);?>

</a>
</div>
</div>
</td>
<?php endif; ?>
<?php $this->assign('lastIndex', $this->_tpl_vars['peer']['peerIndex']); ?>
<?php $this->assign('columnIndex', $this->_tpl_vars['columnIndex']+1); ?>
<?php endforeach; endif; unset($_from); ?>
</tr>
</table>
</div>
<?php endif; ?>
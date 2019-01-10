<?php /* Smarty version 2.6.16, created on 2008-08-07 10:53:50
         compiled from gallery:modules/core/templates/blocks/PeerList.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'gallery:modules/core/templates/blocks/PeerList.tpl', 7, false),array('modifier', 'markup', 'gallery:modules/core/templates/blocks/PeerList.tpl', 12, false),array('modifier', 'entitytruncate', 'gallery:modules/core/templates/blocks/PeerList.tpl', 21, false),)), $this); ?>
<?php echo $this->_reg_objects['g'][0]->callback(array('type' => "core.LoadPeers",'item' => ((is_array($_tmp=@$this->_tpl_vars['item'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['theme']['item']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['theme']['item'])),'windowSize' => ((is_array($_tmp=@$this->_tpl_vars['windowSize'])) ? $this->_run_mod_handler('default', true, $_tmp, null) : smarty_modifier_default($_tmp, null))), $this);?>

<?php $this->assign('data', $this->_tpl_vars['block']['core']['LoadPeers']);  if (! empty ( $this->_tpl_vars['data']['peers'] )): ?>
<div class="<?php echo $this->_tpl_vars['class']; ?>
">
<h3 class="parent"> <?php echo ((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['data']['parent']['title'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['data']['parent']['pathComponent']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['data']['parent']['pathComponent'])))) ? $this->_run_mod_handler('markup', true, $_tmp) : smarty_modifier_markup($_tmp)); ?>
 </h3>
<?php $this->assign('lastIndex', 0);  $_from = $this->_tpl_vars['data']['peers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['peer']):
 $this->assign('title', ((is_array($_tmp=@$this->_tpl_vars['peer']['title'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['peer']['pathComponent']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['peer']['pathComponent'])));  if (( $this->_tpl_vars['peer']['peerIndex'] - $this->_tpl_vars['lastIndex'] > 1 )): ?>
<span class="neck">...</span>
<?php endif;  if (( $this->_tpl_vars['peer']['peerIndex'] == $this->_tpl_vars['data']['thisPeerIndex'] )): ?>
<span class="current">
<?php echo $this->_reg_objects['g'][0]->text(array('text' => "%d. %s",'arg1' => $this->_tpl_vars['peer']['peerIndex'],'arg2' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['title'])) ? $this->_run_mod_handler('markup', true, $_tmp, 'strip') : smarty_modifier_markup($_tmp, 'strip')))) ? $this->_run_mod_handler('entitytruncate', true, $_tmp, 14) : smarty_modifier_entitytruncate($_tmp, 14))), $this);?>

</span>
<?php else: ?>
<a href="<?php echo $this->_reg_objects['g'][0]->url(array('params' => $this->_tpl_vars['theme']['pageUrl'],'arg1' => "itemId=".($this->_tpl_vars['peer']['id'])), $this);?>
">
<?php echo $this->_reg_objects['g'][0]->text(array('text' => "%d. %s",'arg1' => $this->_tpl_vars['peer']['peerIndex'],'arg2' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['title'])) ? $this->_run_mod_handler('markup', true, $_tmp, 'strip') : smarty_modifier_markup($_tmp, 'strip')))) ? $this->_run_mod_handler('entitytruncate', true, $_tmp, 14) : smarty_modifier_entitytruncate($_tmp, 14))), $this);?>

</a>
<?php endif;  $this->assign('lastIndex', $this->_tpl_vars['peer']['peerIndex']);  endforeach; endif; unset($_from); ?>
</div>
<?php endif; ?>
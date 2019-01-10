<?php /* Smarty version 2.6.16, created on 2008-08-07 10:53:50
         compiled from gallery:modules/core/templates/blocks/ItemLinks.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'gallery:modules/core/templates/blocks/ItemLinks.tpl', 32, false),array('modifier', 'lower', 'gallery:modules/core/templates/blocks/ItemLinks.tpl', 34, false),)), $this); ?>
<?php if (! isset ( $this->_tpl_vars['links'] ) && isset ( $this->_tpl_vars['theme']['itemLinks'] )):  $this->assign('links', $this->_tpl_vars['theme']['itemLinks']);  endif;  if (! empty ( $this->_tpl_vars['links'] )):  if (empty ( $this->_tpl_vars['item'] )):  $this->assign('item', $this->_tpl_vars['theme']['item']);  endif;  if (! isset ( $this->_tpl_vars['lowercase'] )):  $this->assign('lowercase', false);  endif;  if (! isset ( $this->_tpl_vars['useDropdown'] )):  $this->assign('useDropdown', true);  endif; ?>
<div class="<?php echo $this->_tpl_vars['class']; ?>
">
<?php if (count ( $this->_tpl_vars['links'] ) > 1 && $this->_tpl_vars['useDropdown']): ?>
<select onchange="var value = this.value; this.options[0].selected = true; eval(value)">
<option value="">
<?php if ($this->_tpl_vars['item']['canContainChildren']):  echo $this->_reg_objects['g'][0]->text(array('text' => "&laquo; album actions &raquo;"), $this);?>

<?php else:  echo $this->_reg_objects['g'][0]->text(array('text' => "&laquo; item actions &raquo;"), $this);?>

<?php endif; ?>
</option>
<?php $_from = $this->_tpl_vars['links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['link']):
?>
<option value="<?php if (isset ( $this->_tpl_vars['link']['script'] )):  echo $this->_tpl_vars['link']['script'];  else: ?>window.location = '<?php echo $this->_reg_objects['g'][0]->url(array('params' => ((is_array($_tmp=@$this->_tpl_vars['link']['params'])) ? $this->_run_mod_handler('default', true, $_tmp, null) : smarty_modifier_default($_tmp, null)),'options' => ((is_array($_tmp=@$this->_tpl_vars['link']['options'])) ? $this->_run_mod_handler('default', true, $_tmp, null) : smarty_modifier_default($_tmp, null))), $this);?>
'<?php endif; ?>"<?php if (! empty ( $this->_tpl_vars['link']['selected'] )): ?> selected="selected"<?php endif; ?>>
<?php if ($this->_tpl_vars['lowercase']):  echo ((is_array($_tmp=$this->_tpl_vars['link']['text'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>

<?php else:  echo $this->_tpl_vars['link']['text']; ?>

<?php endif; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
<?php else:  $_from = $this->_tpl_vars['links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['link']):
?>
<a class="gbAdminLink <?php echo $this->_reg_objects['g'][0]->linkid(array('urlParams' => ((is_array($_tmp=@$this->_tpl_vars['link']['params'])) ? $this->_run_mod_handler('default', true, $_tmp, null) : smarty_modifier_default($_tmp, null))), $this);?>
" href="<?php echo $this->_reg_objects['g'][0]->url(array('params' => ((is_array($_tmp=@$this->_tpl_vars['link']['params'])) ? $this->_run_mod_handler('default', true, $_tmp, null) : smarty_modifier_default($_tmp, null)),'options' => ((is_array($_tmp=@$this->_tpl_vars['link']['options'])) ? $this->_run_mod_handler('default', true, $_tmp, null) : smarty_modifier_default($_tmp, null))), $this);?>
"<?php if (isset ( $this->_tpl_vars['link']['script'] )): ?> onclick="<?php echo $this->_tpl_vars['link']['script']; ?>
"<?php endif;  if (isset ( $this->_tpl_vars['link']['attrs'] )): ?> <?php echo $this->_tpl_vars['link']['attrs'];  endif; ?>><?php if ($this->_tpl_vars['lowercase']):  echo ((is_array($_tmp=$this->_tpl_vars['link']['text'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp));  else:  echo $this->_tpl_vars['link']['text'];  endif; ?></a>
<?php endforeach; endif; unset($_from);  endif; ?>
</div>
<?php endif; ?>
<?php /* Smarty version 2.6.16, created on 2008-08-07 10:53:50
         compiled from gallery:modules/core/templates/blocks/GuestPreview.tpl */ ?>
<?php if ($this->_tpl_vars['user']['isRegisteredUser']): ?>
<div class="<?php echo $this->_tpl_vars['class']; ?>
">
<?php ob_start();  if (( $this->_tpl_vars['theme']['guestPreviewMode'] )): ?>
<a href="<?php echo $this->_reg_objects['g'][0]->url(array('arg1' => "controller=core.ShowItem",'arg2' => "guestPreviewMode=0",'arg3' => "return=1"), $this);?>
"><?php echo $this->_tpl_vars['user']['userName']; ?>
</a> | <span class="active"> <?php echo $this->_reg_objects['g'][0]->text(array('text' => 'guest'), $this);?>
 </span>
<?php else: ?>
<span class="active"> <?php echo $this->_tpl_vars['user']['userName']; ?>
 </span> | <a href="<?php echo $this->_reg_objects['g'][0]->url(array('arg1' => "controller=core.ShowItem",'arg2' => "guestPreviewMode=1",'arg3' => "return=1"), $this);?>
"><?php echo $this->_reg_objects['g'][0]->text(array('text' => 'guest'), $this);?>
</a>
<?php endif;  $this->_smarty_vars['capture']['guestPreviewMode'] = ob_get_contents(); ob_end_clean();  echo $this->_reg_objects['g'][0]->text(array('text' => "display mode: %s",'arg1' => $this->_smarty_vars['capture']['guestPreviewMode']), $this);?>

</div>
<?php endif; ?>
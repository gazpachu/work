<?php /* Smarty version 2.6.16, created on 2008-08-07 10:53:50
         compiled from gallery:modules/core/templates/blocks/NavigationLinks.tpl */ ?>
<?php if (! empty ( $this->_tpl_vars['navigationLinks'] )): ?>
<div class="<?php echo $this->_tpl_vars['class']; ?>
">
<h3> <?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Navigation'), $this);?>
 </h3>
<ul>
<?php $_from = $this->_tpl_vars['navigationLinks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['link']):
?>
<li>
<a href="<?php echo $this->_tpl_vars['link']['url']; ?>
">
<?php echo $this->_tpl_vars['link']['name']; ?>

</a>
</li>
<?php endforeach; endif; unset($_from); ?>
</ul>
</div>
<?php endif; ?>
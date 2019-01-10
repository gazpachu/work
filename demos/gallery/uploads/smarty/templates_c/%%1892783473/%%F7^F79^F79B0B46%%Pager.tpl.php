<?php /* Smarty version 2.6.16, created on 2008-08-07 10:55:39
         compiled from gallery:modules/core/templates/blocks/Pager.tpl */ ?>
<div class="<?php echo $this->_tpl_vars['class']; ?>
">
<?php echo $this->_reg_objects['g'][0]->text(array('text' => "Page:"), $this);?>

<?php $this->assign('lastPage', 0);  $_from = $this->_tpl_vars['theme']['jumpRange']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['jumpRange'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['jumpRange']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['page']):
        $this->_foreach['jumpRange']['iteration']++;
 if (( $this->_tpl_vars['page'] - $this->_tpl_vars['lastPage'] >= 2 )): ?>
<span>
<?php if (( $this->_tpl_vars['page'] - $this->_tpl_vars['lastPage'] == 2 )): ?>
<a href="<?php echo $this->_reg_objects['g'][0]->url(array('params' => $this->_tpl_vars['theme']['pageUrl'],'arg1' => "page=".($this->_tpl_vars['page']-1)), $this);?>
"><?php echo $this->_tpl_vars['page']-1; ?>
</a>
<?php else: ?>
...
<?php endif; ?>
</span>
<?php endif; ?>
<span>
<?php if (( $this->_tpl_vars['theme']['currentPage'] == $this->_tpl_vars['page'] )):  echo $this->_tpl_vars['page']; ?>

<?php else: ?>
<a href="<?php echo $this->_reg_objects['g'][0]->url(array('params' => $this->_tpl_vars['theme']['pageUrl'],'arg1' => "page=".($this->_tpl_vars['page'])), $this);?>
"><?php echo $this->_tpl_vars['page']; ?>
</a>
<?php endif; ?>
</span>
<?php $this->assign('lastPage', $this->_tpl_vars['page']);  endforeach; endif; unset($_from); ?>
</div>
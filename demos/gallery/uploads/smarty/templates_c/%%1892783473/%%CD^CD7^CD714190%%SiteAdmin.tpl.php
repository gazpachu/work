<?php /* Smarty version 2.6.16, created on 2008-08-07 10:56:00
         compiled from gallery:modules/core/templates/SiteAdmin.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'gallery:modules/core/templates/SiteAdmin.tpl', 8, false),)), $this); ?>
<form action="<?php echo $this->_reg_objects['g'][0]->url(array(), $this);?>
" method="post" id="siteAdminForm"
enctype="<?php echo ((is_array($_tmp=@$this->_tpl_vars['SiteAdmin']['enctype'])) ? $this->_run_mod_handler('default', true, $_tmp, "application/x-www-form-urlencoded") : smarty_modifier_default($_tmp, "application/x-www-form-urlencoded")); ?>
">
<div>
<?php echo $this->_reg_objects['g'][0]->hiddenFormVars(array(), $this);?>

<?php if (! empty ( $this->_tpl_vars['controller'] )): ?>
<input type="hidden" name="<?php echo $this->_reg_objects['g'][0]->formVar(array('var' => 'controller'), $this);?>
" value="<?php echo $this->_tpl_vars['controller']; ?>
"/>
<?php endif;  if (! empty ( $this->_tpl_vars['form']['formName'] )): ?>
<input type="hidden" name="<?php echo $this->_reg_objects['g'][0]->formVar(array('var' => "form[formName]"), $this);?>
" value="<?php echo $this->_tpl_vars['form']['formName']; ?>
" />
<?php endif; ?>
</div>
<table width="100%" cellspacing="0" cellpadding="0">
<tr valign="top">
<td id="gsSidebarCol"><div id="gsSidebar" class="gcBorder1">
<div class="gbBlock">
<h2> <?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Admin Options'), $this);?>
 </h2>
<ul id="gbSiteAdminLinks">
<?php $_from = $this->_tpl_vars['SiteAdmin']['subViewGroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['group']):
?>
<li> <span><?php echo $this->_tpl_vars['group']['0']['groupLabel']; ?>
</span>
<ul>
<?php $_from = $this->_tpl_vars['group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['choice']):
?>
<li class="<?php echo $this->_reg_objects['g'][0]->linkId(array('view' => $this->_tpl_vars['choice']['view']['subView']), $this);?>
">
<?php if (! empty ( $this->_tpl_vars['choice']['selected'] )):  echo $this->_tpl_vars['choice']['name']; ?>

<?php else: ?>
<a href="<?php echo $this->_reg_objects['g'][0]->url(array('params' => $this->_tpl_vars['choice']['view']), $this);?>
">
<?php echo $this->_tpl_vars['choice']['name']; ?>

</a>
<?php endif; ?>
</li>
<?php endforeach; endif; unset($_from); ?>
</ul>
</li>
<?php endforeach; endif; unset($_from); ?>
</ul>
</div>
<?php echo $this->_reg_objects['g'][0]->block(array('type' => "core.NavigationLinks",'class' => 'gbBlock','navigationLinks' => $this->_tpl_vars['SiteAdmin']['navigationLinks']), $this);?>

</div></td>
<td>
<div id="gsContent" class="gcBorder1">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "gallery:".($this->_tpl_vars['SiteAdmin']['viewBodyFile']), 'smarty_include_vars' => array('l10Domain' => $this->_tpl_vars['SiteAdmin']['viewL10Domain'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
</td>
</tr></table>
</form>
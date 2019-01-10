<?php /* Smarty version 2.6.16, created on 2008-08-07 10:57:04
         compiled from gallery:modules/core/templates/ShowItemError.tpl */ ?>
<div class="gbBlock gcBackground1">
<h2> <?php echo $this->_reg_objects['g'][0]->text(array('text' => "Configuration Error: Missing Theme"), $this);?>
 </h2>
</div>
<div class="gbBlock">
<h3> <?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Missing Theme'), $this);?>
 </h3>
<p class="giDescription">
<?php ob_start(); ?>
<b><?php echo $this->_tpl_vars['ShowItemError']['themeId']; ?>
</b>
<?php $this->_smarty_vars['capture']['themeId'] = ob_get_contents(); ob_end_clean();  if (empty ( $this->_tpl_vars['ShowItemError']['itemId'] )):  echo $this->_reg_objects['g'][0]->text(array('text' => "This page is configured to use the %s theme, but it is either inactive, not installed, or incompatible.",'arg1' => $this->_smarty_vars['capture']['themeId']), $this);?>

<?php else:  echo $this->_reg_objects['g'][0]->text(array('text' => "This album is configured to use the %s theme, but it is either inactive, not installed, or incompatible.",'arg1' => $this->_smarty_vars['capture']['themeId']), $this);?>

<?php ob_start(); ?>
<a href="<?php echo $this->_reg_objects['g'][0]->url(array('arg1' => "view=core.ItemAdmin",'arg2' => "subView=core.ItemEdit",'arg3' => "editPlugin=ItemEditAlbum",'arg4' => "itemId=".($this->_tpl_vars['ShowItemError']['itemId']),'arg5' => "return=1"), $this);?>
">
<?php $this->_smarty_vars['capture']['editLink'] = ob_get_contents(); ob_end_clean();  endif;  ob_start(); ?>
<a href="<?php echo $this->_reg_objects['g'][0]->url(array('arg1' => "view=core.UserAdmin",'arg2' => "subView=core.UserLogin",'arg3' => "return=1"), $this);?>
">
<?php $this->_smarty_vars['capture']['loginLink'] = ob_get_contents(); ob_end_clean();  ob_start(); ?>
<a href="<?php echo $this->_reg_objects['g'][0]->url(array('arg1' => "view=core.SiteAdmin",'arg2' => "subView=core.AdminPlugins",'arg3' => "mode=config",'arg4' => "return=1"), $this);?>
">
<?php $this->_smarty_vars['capture']['adminLink'] = ob_get_contents(); ob_end_clean();  if (isset ( $this->_tpl_vars['theme']['isFallback'] ) && empty ( $this->_tpl_vars['ShowItemError']['itemId'] )):  if ($this->_tpl_vars['ShowItemError']['isAdmin']):  echo $this->_reg_objects['g'][0]->text(array('text' => "To fix this problem you can %sinstall or activate this theme%s or select another default theme.",'arg1' => $this->_smarty_vars['capture']['adminLink'],'arg2' => "</a>"), $this);?>

<?php else:  echo $this->_reg_objects['g'][0]->text(array('text' => "To fix this problem you can %slogin as a site administrator%s and then %sinstall or activate this theme%s or select another default theme.",'arg1' => $this->_smarty_vars['capture']['loginLink'],'arg2' => "</a>",'arg3' => $this->_smarty_vars['capture']['adminLink'],'arg4' => "</a>"), $this);?>

<?php endif;  else:  if ($this->_tpl_vars['ShowItemError']['isAdmin']):  echo $this->_reg_objects['g'][0]->text(array('text' => "To fix this problem you can either %schoose a new theme for this album%s or %sinstall or activate this theme%s.",'arg1' => $this->_smarty_vars['capture']['editLink'],'arg2' => "</a>",'arg3' => $this->_smarty_vars['capture']['adminLink'],'arg4' => "</a>"), $this);?>

<?php elseif ($this->_tpl_vars['ShowItemError']['canEdit']):  echo $this->_reg_objects['g'][0]->text(array('text' => "To fix this problem you can either %schoose a new theme for this album%s or %slogin as a site administrator%s and then %sinstall or activate this theme%s.",'arg1' => $this->_smarty_vars['capture']['editLink'],'arg2' => "</a>",'arg3' => $this->_smarty_vars['capture']['loginLink'],'arg4' => "</a>",'arg5' => $this->_smarty_vars['capture']['adminLink'],'arg6' => "</a>"), $this);?>

<?php else:  echo $this->_reg_objects['g'][0]->text(array('text' => "To fix this problem you can either %slogin%s and then %schoose a new theme for this album%s or %slogin as a site administrator%s and then %sinstall or activate this theme%s.",'arg1' => $this->_smarty_vars['capture']['loginLink'],'arg2' => "</a>",'arg3' => $this->_smarty_vars['capture']['editLink'],'arg4' => "</a>",'arg5' => $this->_smarty_vars['capture']['loginLink'],'arg6' => "</a>",'arg7' => $this->_smarty_vars['capture']['adminLink'],'arg8' => "</a>"), $this);?>

<?php endif;  endif; ?>
</p>
</div>
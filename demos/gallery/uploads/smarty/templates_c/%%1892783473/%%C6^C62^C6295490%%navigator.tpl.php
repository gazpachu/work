<?php /* Smarty version 2.6.16, created on 2008-08-07 11:06:34
         compiled from gallery:themes/gecko/templates/navigator.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'gallery:themes/gecko/templates/navigator.tpl', 7, false),array('modifier', 'escape', 'gallery:themes/gecko/templates/navigator.tpl', 86, false),)), $this); ?>
<?php $this->assign('prefix', ((is_array($_tmp=@$this->_tpl_vars['prefix'])) ? $this->_run_mod_handler('default', true, $_tmp, "") : smarty_modifier_default($_tmp, "")));  $this->assign('suffix', ((is_array($_tmp=@$this->_tpl_vars['suffix'])) ? $this->_run_mod_handler('default', true, $_tmp, "") : smarty_modifier_default($_tmp, ""))); ?>
<div>
<table width="100%" cellpadding="0" cellspacing="0"><tr>
<td width="20%" align="left">
<div class="first-and-previous">
<table cellpadding="0" cellspacing="0"><tr>
<?php if (isset ( $this->_tpl_vars['theme']['navigator']['first'] )): ?>
<td>
<div class="buttonFirst"><a href="<?php echo $this->_reg_objects['g'][0]->url(array('params' => $this->_tpl_vars['theme']['navigator']['first']['urlParams']), $this);?>
"
title="<?php echo $this->_reg_objects['g'][0]->text(array('text' => 'First'), $this);?>
"></a></div>
</td>
<?php endif;  if (isset ( $this->_tpl_vars['theme']['navigator']['back'] )): ?>    <td>
<div class="buttonPrev"><a href="<?php echo $this->_reg_objects['g'][0]->url(array('params' => $this->_tpl_vars['theme']['navigator']['back']['urlParams']), $this);?>
"
title="<?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Previous'), $this);?>
"></a></div>
</td>
<?php endif; ?>
<td>&nbsp;</td>
</tr></table>
</div>
</td>
<td align="center">
<?php if ($this->_tpl_vars['theme']['pageType'] == 'album'):  if (! empty ( $this->_tpl_vars['theme']['jumpRange'] )): ?>
<div class="gsPages">
<?php echo $this->_reg_objects['g'][0]->block(array('type' => "core.Pager"), $this);?>

</div>
<?php else: ?>
&nbsp;
<?php endif;  elseif ($this->_tpl_vars['theme']['pageType'] == 'photo'): ?>
<table cellpadding="0" cellspacing="0">
<tr>
<?php if (( isset ( $this->_tpl_vars['links'] ) || isset ( $this->_tpl_vars['theme']['itemLinks'] ) )):  if (! isset ( $this->_tpl_vars['links'] )):  $this->assign('links', $this->_tpl_vars['theme']['itemLinks']);  endif;  $_from = $this->_tpl_vars['links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['itemLink']):
 if ($this->_tpl_vars['itemLink']['moduleId'] == 'cart'): ?>
<td class="gsActionIcon">
<div class="buttonCart"><a href="<?php echo $this->_reg_objects['g'][0]->url(array('params' => $this->_tpl_vars['itemLink']['params']), $this);?>
"
title="<?php echo $this->_tpl_vars['itemLink']['text']; ?>
"></a></div>
</td>
<?php elseif ($this->_tpl_vars['itemLink']['moduleId'] == 'comment'):  if ($this->_tpl_vars['itemLink']['params']['view'] == "comment.AddComment"): ?>
<td class="gsActionIcon">
<div class="buttonAddComment"><a href="<?php echo $this->_reg_objects['g'][0]->url(array('params' => $this->_tpl_vars['itemLink']['params']), $this);?>
"
title="<?php echo $this->_tpl_vars['itemLink']['text']; ?>
"></a></div>
</td>
<?php endif;  endif;  endforeach; endif; unset($_from);  endif;  if ($this->_tpl_vars['theme']['params']['photoProperties']):  $_from = $this->_tpl_vars['theme']['params']['photoBlocks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['block']):
 if ($this->_tpl_vars['block']['0'] == 'exif.ExifInfo'):  if (empty ( $this->_tpl_vars['item'] )): ?> <?php $this->assign('item', $this->_tpl_vars['theme']['item']); ?> <?php endif;  echo $this->_reg_objects['g'][0]->callback(array('type' => "exif.LoadExifInfo",'itemId' => $this->_tpl_vars['item']['id']), $this);?>

<?php if (! empty ( $this->_tpl_vars['block']['exif']['LoadExifInfo']['exifData'] )): ?>
<td class="gsActionIcon">
<div class="buttonExif"><a href="javascript:void(0);"
onclick="toggleExif('photo','exif'); return false;"
title="<?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Photo Properties'), $this);?>
"></a></div>
</td>
<?php endif;  endif;  endforeach; endif; unset($_from);  endif;  if ($this->_tpl_vars['theme']['params']['fullSize'] && ! empty ( $this->_tpl_vars['theme']['sourceImage'] ) && count ( $this->_tpl_vars['theme']['imageViews'] ) > 1):  ob_start();  echo $this->_reg_objects['g'][0]->url(array('arg1' => "view=core.DownloadItem",'arg2' => "itemId=".($this->_tpl_vars['theme']['sourceImage']['id'])), $this); $this->_smarty_vars['capture']['url'] = ob_get_contents(); ob_end_clean(); ?>
<td class="gsActionIcon">
<div class="buttonPopup"><a href="<?php echo $this->_smarty_vars['capture']['url']; ?>
" target="_blank"
onclick="popImage(this.href, '<?php echo ((is_array($_tmp=$this->_tpl_vars['theme']['item']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
'); return false;"
title="<?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Full Size'), $this);?>
"></a></div>
</td>
<?php endif; ?>
</tr>
</table>
<?php endif; ?>
</td>
<td width="20%" align="right" >
<div class="next-and-last">
<table cellpadding="0" cellspacing="0"><tr>
<td>&nbsp;</td>
<?php if (isset ( $this->_tpl_vars['theme']['navigator']['next'] )): ?>    <td>
<div class="buttonNext"><a href="<?php echo $this->_reg_objects['g'][0]->url(array('params' => $this->_tpl_vars['theme']['navigator']['next']['urlParams']), $this);?>
"
title="<?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Next'), $this);?>
"></a></div>
</td>
<?php endif;  if (isset ( $this->_tpl_vars['theme']['navigator']['last'] )): ?>
<td>
<div class="buttonLast"><a href="<?php echo $this->_reg_objects['g'][0]->url(array('params' => $this->_tpl_vars['theme']['navigator']['last']['urlParams']), $this);?>
"
title="<?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Last'), $this);?>
"></a></div>
</td>
<?php endif; ?>
</tr></table>
</div>
</td>
</tr></table>
</div>
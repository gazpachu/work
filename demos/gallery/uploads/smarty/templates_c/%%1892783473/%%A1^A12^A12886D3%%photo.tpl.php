<?php /* Smarty version 2.6.16, created on 2008-08-07 11:06:41
         compiled from gallery:themes/gecko/templates/photo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'markup', 'gallery:themes/gecko/templates/photo.tpl', 110, false),)), $this); ?>
<?php if (! empty ( $this->_tpl_vars['theme']['imageViews'] )): ?>
<?php $this->assign('image', $this->_tpl_vars['theme']['imageViews'][$this->_tpl_vars['theme']['imageViewsIndex']]); ?>
<?php endif; ?>
<?php if (! empty ( $this->_tpl_vars['theme']['params']['sidebarBlocks'] )): ?>
<?php echo $this->_reg_objects['g'][0]->theme(array('include' => "sidebar.tpl"), $this);?>

<?php endif; ?>
<table class="gcBackground3" width="820" cellspacing="0" cellpadding="0" align="center">
<tr valign="top">
<td>
<div id="gsContent" class="gcBorder1">
<div class="gbBlockTop">
<table>
<tr>
<td class="gsActionIcon">
<div class="buttonShowSidebar"><a href="javascript: slideIn('sidebar')" title="Show Menu"></a></div>
</td>
<?php if (( isset ( $this->_tpl_vars['links'] ) || isset ( $this->_tpl_vars['theme']['itemLinks'] ) )): ?>
<?php if (! isset ( $this->_tpl_vars['links'] )):  $this->assign('links', $this->_tpl_vars['theme']['itemLinks']);  endif; ?>
<?php $_from = $this->_tpl_vars['links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['link']):
?>
<?php if ($this->_tpl_vars['link']['moduleId'] == 'slideshow'): ?>
<td class="gsActionIcon">
<div class="buttonViewSlideshow"><a href="<?php echo $this->_reg_objects['g'][0]->url(array('params' => $this->_tpl_vars['link']['params']), $this);?>
" title="<?php echo $this->_tpl_vars['link']['text']; ?>
"></a></div>
</td>
<?php elseif ($this->_tpl_vars['link']['moduleId'] == 'comment'): ?>
<?php if ($this->_tpl_vars['link']['params']['view'] == "comment.ShowAllComments"): ?>
<td class="gsActionIcon">
<div class="buttonViewComments"><a href="<?php echo $this->_reg_objects['g'][0]->url(array('params' => $this->_tpl_vars['link']['params']), $this);?>
" title="<?php echo $this->_tpl_vars['link']['text']; ?>
"></a></div>
</td>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
</tr>
</table>
</div>
<div class="gsContentPhoto">
<table align="center" cellpadding="0" cellspacing="0">
<?php if ($this->_tpl_vars['theme']['params']['navigatorPhotoTop']): ?>
<tr>
<td class="gbNavigatorPhoto">
<div class="gbNavigator">
<?php echo $this->_reg_objects['g'][0]->theme(array('include' => "navigator.tpl"), $this);?>

</div>
</td>
<td>
<?php echo $this->_reg_objects['g'][0]->text(array('text' => "&nbsp;"), $this);?>

</td>
</tr>
<?php endif; ?>
<tr>
<td>
<div id="gsImageView" class="gbBlock">
<?php if (! empty ( $this->_tpl_vars['theme']['imageViews'] )): ?>
<?php ob_start(); ?>
<a href="<?php echo $this->_reg_objects['g'][0]->url(array('arg1' => "view=core.DownloadItem",'arg2' => "itemId=".($this->_tpl_vars['theme']['item']['id']),'forceFullUrl' => true,'forceSessionId' => true), $this);?>
">
<?php echo $this->_reg_objects['g'][0]->text(array('text' => "Download %s",'arg1' => $this->_tpl_vars['theme']['sourceImage']['itemTypeName']['1']), $this);?>

</a>
<?php $this->_smarty_vars['capture']['fallback'] = ob_get_contents(); ob_end_clean(); ?>
<?php if (( $this->_tpl_vars['image']['viewInline'] )): ?>
<?php if (isset ( $this->_tpl_vars['theme']['photoFrame'] )): ?>
<?php $this->_tag_stack[] = array('container', array('type' => "imageframe.ImageFrame",'frame' => $this->_tpl_vars['theme']['photoFrame'],'width' => $this->_tpl_vars['image']['width'],'height' => $this->_tpl_vars['image']['height']), $this); $_block_repeat=true; $this->_reg_objects['g'][0]->container($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat); while ($_block_repeat) { ob_start();?>
<div id="photo">
<?php echo $this->_reg_objects['g'][0]->image(array('id' => "%ID%",'item' => $this->_tpl_vars['theme']['item'],'image' => $this->_tpl_vars['image'],'fallback' => $this->_smarty_vars['capture']['fallback'],'class' => "%CLASS%"), $this);?>

</div>
<?php $_obj_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_reg_objects['g'][0]->container($this->_tag_stack[count($this->_tag_stack)-1][1], $_obj_block_content, $this, $_block_repeat);} array_pop($this->_tag_stack);?>

<?php else: ?>
<div id="photo">
<?php echo $this->_reg_objects['g'][0]->image(array('item' => $this->_tpl_vars['theme']['item'],'image' => $this->_tpl_vars['image'],'fallback' => $this->_smarty_vars['capture']['fallback']), $this);?>

</div>
<?php endif; ?>
<?php else: ?>
<?php echo $this->_smarty_vars['capture']['fallback']; ?>

<?php endif; ?>
<?php else: ?>
<?php echo $this->_reg_objects['g'][0]->text(array('text' => "There is nothing to view for this item."), $this);?>

<?php endif; ?>
</div>
</td>
</tr>
<?php if ($this->_tpl_vars['theme']['params']['navigatorPhotoBottom']): ?>
<tr>
<td class="gbNavigatorPhoto">
<div class="gbNavigator">
<?php echo $this->_reg_objects['g'][0]->theme(array('include' => "navigator.tpl"), $this);?>

</div>
</td>
<td>
<?php echo $this->_reg_objects['g'][0]->text(array('text' => "&nbsp;"), $this);?>

</td>
</tr>
<?php endif; ?>
</table>
</div>
<table align="center" width="70%">
<td align="left" valign="top">
<div class="gsContentDetail">
<div class="gbBlock">
<?php if (! empty ( $this->_tpl_vars['theme']['item']['title'] )): ?>
<h2> <?php echo ((is_array($_tmp=$this->_tpl_vars['theme']['item']['title'])) ? $this->_run_mod_handler('markup', true, $_tmp) : smarty_modifier_markup($_tmp)); ?>
 </h2>
<?php endif; ?>
<?php if (! empty ( $this->_tpl_vars['theme']['item']['description'] )): ?>
<p class="giDescription">
<?php echo ((is_array($_tmp=$this->_tpl_vars['theme']['item']['description'])) ? $this->_run_mod_handler('markup', true, $_tmp) : smarty_modifier_markup($_tmp)); ?>

</p>
<?php endif; ?>
</td>
</table>
<table align="center">
<td align="center" width="240" valign="top">
<?php if ($this->_tpl_vars['theme']['params']['showMicroThumbs']): ?>
<div class="gsContentDetail gcBorder6">
<div class="gbNavigatorMicroThums">
<?php echo $this->_reg_objects['g'][0]->theme(array('include' => "navigatorMicroThumbs.tpl"), $this);?>

</div>
</div>
<?php endif; ?>
</td>
</table>
<table align="center" width="65%">
<td align="left" valign="top">
<div class="gbBlock">
<?php echo $this->_reg_objects['g'][0]->block(array('type' => "core.ItemInfo",'item' => $this->_tpl_vars['theme']['item'],'showDate' => false,'showOwner' => false,'showViewCount' => false,'class' => 'giInfo'), $this);?>

</div>
<div class="gbBlock">
<?php $_from = $this->_tpl_vars['theme']['params']['photoBlocks2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['block']):
?>
<?php echo $this->_reg_objects['g'][0]->block(array('type' => $this->_tpl_vars['block']['0'],'params' => $this->_tpl_vars['block']['1']), $this);?>

<?php endforeach; endif; unset($_from); ?>
</div>
</div>
</td>
</table>
<?php if (! empty ( $this->_tpl_vars['theme']['sourceImage'] ) && $this->_tpl_vars['theme']['sourceImage']['mimeType'] != $this->_tpl_vars['theme']['item']['mimeType']): ?>
<div class="gbBlock">
<a href="<?php echo $this->_reg_objects['g'][0]->url(array('arg1' => "view=core.DownloadItem",'arg2' => "itemId=".($this->_tpl_vars['theme']['item']['id'])), $this);?>
">
<?php echo $this->_reg_objects['g'][0]->text(array('text' => "Download %s in original format",'arg1' => $this->_tpl_vars['theme']['sourceImage']['itemTypeName']['1']), $this);?>

</a>
</div>
<?php endif; ?>
<?php $_from = $this->_tpl_vars['theme']['params']['photoBlocks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['block']):
?>
<?php if ($this->_tpl_vars['block']['0'] == 'exif.ExifInfo'): ?>
<div id="exif" class="gcPopupBackground" style="position:absolute; left:0px; top:0px; padding:5px; visibility:hidden;">
<table cellspacing="0" cellpadding="0">
<tr>
<td style="padding-left:5px;">
<h2>Exif</h2>
</td>
<td align="right">
<div class="buttonClose"><a href="javascript:void(0);" onclick="toggleExif('photo','exif'); return false;" title="Close"></a></div>
</td>
</tr>
<tr>
<td colspan="2" class="gcBackground2" style="padding-bottom:5px;">
<?php echo $this->_reg_objects['g'][0]->block(array('type' => $this->_tpl_vars['block']['0'],'params' => $this->_tpl_vars['block']['1']), $this);?>

</td>
</tr>
</table>
</div>
<?php else: ?>
<?php echo $this->_reg_objects['g'][0]->block(array('type' => $this->_tpl_vars['block']['0'],'params' => $this->_tpl_vars['block']['1']), $this);?>

<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php echo $this->_reg_objects['g'][0]->block(array('type' => "core.EmergencyEditItemLink",'class' => 'gbBlock','checkSidebarBlocks' => true,'checkPhotoBlocks' => true), $this);?>

</div>
</td>
</tr>
</table>
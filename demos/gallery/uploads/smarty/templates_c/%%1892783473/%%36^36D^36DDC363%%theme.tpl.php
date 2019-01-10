<?php /* Smarty version 2.6.16, created on 2008-08-07 11:06:29
         compiled from gallery:themes/gecko/templates/theme.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'markup', 'gallery:themes/gecko/templates/theme.tpl', 14, false),array('modifier', 'default', 'gallery:themes/gecko/templates/theme.tpl', 18, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<?php echo $this->_reg_objects['g'][0]->head(array(), $this);?>

<?php if ($this->_tpl_vars['theme']['pageType'] == 'album' || $this->_tpl_vars['theme']['pageType'] == 'photo'): ?>
<meta name="keywords" content="<?php echo $this->_tpl_vars['theme']['item']['keywords']; ?>
" />
<meta name="description" content="<?php echo ((is_array($_tmp=$this->_tpl_vars['theme']['item']['description'])) ? $this->_run_mod_handler('markup', true, $_tmp, 'strip') : smarty_modifier_markup($_tmp, 'strip')); ?>
" />
<?php endif; ?>
<?php if (empty ( $this->_tpl_vars['head']['title'] )): ?>
<title><?php echo ((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['theme']['item']['title'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['theme']['item']['pathComponent']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['theme']['item']['pathComponent'])))) ? $this->_run_mod_handler('markup', true, $_tmp, 'strip') : smarty_modifier_markup($_tmp, 'strip')); ?>
</title>
<?php endif; ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_reg_objects['g'][0]->theme(array('url' => "theme.css"), $this);?>
"/>
<script type="text/javascript" src="<?php echo $this->_reg_objects['g'][0]->url(array('href' => 'themes/gecko/theme.js'), $this);?>
"></script>
</head>
<body class="gallery">
<div <?php echo $this->_reg_objects['g'][0]->mainDivAttributes(array(), $this);?>
>
<?php if ($this->_tpl_vars['theme']['useFullScreen']): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "gallery:".($this->_tpl_vars['theme']['moduleTemplate']), 'smarty_include_vars' => array('l10Domain' => $this->_tpl_vars['theme']['moduleL10Domain'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
<div id="gsHeader">
<table width="820" cellspacing="0" cellpadding="0" align="center">
<tr>
<td align="left" valign="top" width="100%">
<img src="<?php echo $this->_reg_objects['g'][0]->url(array('href' => "themes/gecko/images/logo.jpg"), $this);?>
"/>
</td>
<td align="right" valign="top">
<?php echo $this->_reg_objects['g'][0]->theme(array('include' => "ads.tpl"), $this);?>

</td>
</tr>
</table>
</div>
<div>
<table width="820" cellpadding="0" cellspacing="0" align="center" bgcolor="#222222">
<tr>
<td>       
<div id="gsNavBar" class="gcBorder1">
<div class="gbSystemLinks">
<?php echo $this->_reg_objects['g'][0]->block(array('type' => "core.SystemLinks",'order' => "core.SiteAdmin core.YourAccount core.Login core.Logout",'separator' => "&laquo;",'othersAt' => 4), $this);?>
          
<?php if (! empty ( $this->_tpl_vars['theme']['params']['extraLink'] ) && ! empty ( $this->_tpl_vars['theme']['params']['extraLinkUrl'] )): ?>
<span class="block-core-SystemLink">
<a href="<?php echo $this->_tpl_vars['theme']['params']['extraLinkUrl']; ?>
"><?php echo $this->_tpl_vars['theme']['params']['extraLink']; ?>
</a>
</span>
<?php echo $this->_reg_objects['g'][0]->text(array('text' => "&laquo;"), $this);?>

<?php endif; ?>
<span class="block-core-SystemLink">
<a href="javascript: toggleSidebar('sidebar')"><?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Menu'), $this);?>
</a>
</span>
</div>
<div class="gbBreadCrumb">
<?php echo $this->_reg_objects['g'][0]->block(array('type' => "core.BreadCrumb",'separator' => "&raquo;"), $this);?>

</div>
</div>
</td>
</tr>
</table>
</div>
<?php if ($this->_tpl_vars['theme']['pageType'] == 'album'): ?>
<?php echo $this->_reg_objects['g'][0]->theme(array('include' => "album.tpl"), $this);?>

<?php elseif ($this->_tpl_vars['theme']['pageType'] == 'photo'): ?>
<?php echo $this->_reg_objects['g'][0]->theme(array('include' => "photo.tpl"), $this);?>

<?php elseif ($this->_tpl_vars['theme']['pageType'] == 'admin'): ?>
<?php echo $this->_reg_objects['g'][0]->theme(array('include' => "admin.tpl"), $this);?>

<?php elseif ($this->_tpl_vars['theme']['pageType'] == 'module'): ?>
<?php echo $this->_reg_objects['g'][0]->theme(array('include' => "module.tpl"), $this);?>

<?php elseif ($this->_tpl_vars['theme']['pageType'] == 'progressbar'): ?>
<?php echo $this->_reg_objects['g'][0]->theme(array('include' => "progressbar.tpl"), $this);?>

<?php endif; ?>
<table width="820" cellpadding="0" cellspacing="0" align="center">
<tr>
<td>
<div id="gsFooter" class="gcBorder1">
<p align="center">
<a href="http://gallery.menalto.com/">Powered by Gallery</a> | 
<a href="http://www.webmarket.es">Designed by Webmarket</a>
<br/><br/>
<?php echo '';  if (! empty ( $this->_tpl_vars['theme']['params']['copyright'] )):  echo '';  echo $this->_tpl_vars['theme']['params']['copyright'];  echo '';  endif;  echo ''; ?>

</p>
<div id="footerimage">
<table width="820" align="center" cellspacing="0" cellpadding="0" bgcolor="#333333">
<tr>
<td align="center" valign="top" width="820">
<img src="<?php echo $this->_reg_objects['g'][0]->url(array('href' => "themes/gecko/images/footer.gif"), $this);?>
" alt=""/>
</td>
</tr>
</table>
</div> 
<div class="gcBorder1">
<table width="820" cellpadding="0" cellspacing="0" align="center" bgcolor="#333333">
<tr>
<td>
<?php echo $this->_reg_objects['g'][0]->block(array('type' => "core.GuestPreview"), $this);?>

</td>
</tr>
</table>
</div>
<?php endif; ?>  <?php echo $this->_reg_objects['g'][0]->trailer(array(), $this);?>

<?php echo $this->_reg_objects['g'][0]->debug(array(), $this);?>

</div>
</td>
</tr>
</table>
</div>
</body>
</html>
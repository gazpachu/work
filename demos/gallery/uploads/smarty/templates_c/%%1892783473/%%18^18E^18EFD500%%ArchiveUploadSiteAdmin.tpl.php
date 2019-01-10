<?php /* Smarty version 2.6.16, created on 2008-08-07 11:15:33
         compiled from gallery:modules/archiveupload/templates/ArchiveUploadSiteAdmin.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'gallery:modules/archiveupload/templates/ArchiveUploadSiteAdmin.tpl', 76, false),)), $this); ?>
<div class="gbBlock gcBackground1">
<h2> <?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Archive Upload Settings'), $this);?>
 </h2>
</div>
<?php if (isset ( $this->_tpl_vars['status']['saved'] )): ?>
<div class="gbBlock"><h2 class="giSuccess">
<?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Settings saved successfully'), $this);?>

</h2></div>
<?php endif; ?>
<div class="gbBlock">
<p class="giDescription">
<?php echo $this->_reg_objects['g'][0]->text(array('text' => "This module will enable extraction of individual files from a zip archive to add each item to Gallery.  You must locate or install an unzip binary on your server, then enter the path to it in the text box below.  If you're on a Unix machine, don't forget to make the binary executable (<i>chmod 755 unzip</i> in the right directory should do it)"), $this);?>

</p>
<?php echo $this->_reg_objects['g'][0]->text(array('text' => "Path to unzip:"), $this);?>

<input type="text" size="40"
name="<?php echo $this->_reg_objects['g'][0]->formVar(array('var' => "form[unzipPath]"), $this);?>
" value="<?php echo $this->_tpl_vars['form']['unzipPath']; ?>
"
id='giFormPath' autocomplete="off"/>
<?php $this->_tag_stack[] = array('autoComplete', array('element' => 'giFormPath'), $this); $_block_repeat=true; $this->_reg_objects['g'][0]->autoComplete($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat); while ($_block_repeat) { ob_start(); echo $this->_reg_objects['g'][0]->url(array('arg1' => "view=core.SimpleCallback",'arg2' => "command=lookupFiles",'arg3' => "prefix=__VALUE__",'htmlEntities' => false), $this);?>

<?php $_obj_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_reg_objects['g'][0]->autoComplete($this->_tag_stack[count($this->_tag_stack)-1][1], $_obj_block_content, $this, $_block_repeat);} array_pop($this->_tag_stack);?>

<?php if (isset ( $this->_tpl_vars['form']['error']['unzipPath']['missing'] )): ?>
<div class="giError">
<?php echo $this->_reg_objects['g'][0]->text(array('text' => 'You must enter a path to your unzip binary'), $this);?>

</div>
<?php endif;  if (isset ( $this->_tpl_vars['form']['error']['unzipPath']['exec'] )): ?>
<div class="giError">
<?php echo $this->_reg_objects['g'][0]->text(array('text' => "The path you entered doesn't contain a valid unzip binary."), $this);?>

</div>
<?php endif;  if (isset ( $this->_tpl_vars['form']['error']['unzipPath']['badPath'] )): ?>
<div class="giError">
<?php echo $this->_reg_objects['g'][0]->text(array('text' => "The path you entered isn't a valid path to an unzip binary."), $this);?>

</div>
<?php endif;  if (isset ( $this->_tpl_vars['form']['error']['unzipPath']['notExecutable'] )): ?>
<div class="giError">
<?php echo $this->_reg_objects['g'][0]->text(array('text' => "The unzip binary is not executable.  To fix it, run <b>chmod 755 %s</b>",'arg1' => $this->_tpl_vars['form']['unzipPath']), $this);?>

</div>
<?php endif; ?>
<br/>
<input type="checkbox" id="cbRemoveMeta"
name="<?php echo $this->_reg_objects['g'][0]->formVar(array('var' => "form[removeMeta]"), $this);?>
"<?php if ($this->_tpl_vars['form']['removeMeta']): ?> checked="checked"<?php endif; ?>/>
<label for="cbRemoveMeta">
<?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Discard archive contents recognized as folder metadata'), $this);?>

(Thumbs.db, .DS_Store, .Trashes, __MACOSX)
</label>
</div>
<div class="gbBlock gcBackground1">
<input type="submit" class="inputTypeSubmit"
name="<?php echo $this->_reg_objects['g'][0]->formVar(array('var' => "form[action][save]"), $this);?>
" value="<?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Save Settings'), $this);?>
"/>
<input type="submit" class="inputTypeSubmit"
name="<?php echo $this->_reg_objects['g'][0]->formVar(array('var' => "form[action][test]"), $this);?>
" value="<?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Test Settings'), $this);?>
"/>
<?php if ($this->_tpl_vars['form']['isConfigure']): ?>
<input type="submit" class="inputTypeSubmit"
name="<?php echo $this->_reg_objects['g'][0]->formVar(array('var' => "form[action][cancel]"), $this);?>
" value="<?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Cancel'), $this);?>
"/>
<?php else: ?>
<input type="submit" class="inputTypeSubmit"
name="<?php echo $this->_reg_objects['g'][0]->formVar(array('var' => "form[action][reset]"), $this);?>
" value="<?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Reset'), $this);?>
"/>
<?php endif; ?>
</div>
<?php if (! empty ( $this->_tpl_vars['ArchiveUploadSiteAdmin']['tests'] )): ?>
<div class="gbBlock">
<h3> <?php echo $this->_reg_objects['g'][0]->text(array('text' => 'unzip binary test results'), $this);?>
 </h3>
<table class="gbDataTable"><tr>
<th> <?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Binary Name'), $this);?>
 </th>
<th> <?php echo $this->_reg_objects['g'][0]->text(array('text' => "Pass/Fail"), $this);?>
 </th>
</tr>
<?php $_from = $this->_tpl_vars['ArchiveUploadSiteAdmin']['tests']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['test']):
?>
<tr class="<?php echo smarty_function_cycle(array('values' => "gbEven,gbOdd"), $this);?>
">
<td>
<?php echo $this->_tpl_vars['test']['name']; ?>

</td><td>
<?php if (( $this->_tpl_vars['test']['success'] )): ?>
<div class="giSuccess">
<?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Passed'), $this);?>

</div>
<?php else: ?>
<div class="giError">
<?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Failed'), $this);?>

</div>
<?php if (! empty ( $this->_tpl_vars['test']['message'] )):  echo $this->_reg_objects['g'][0]->text(array('text' => "Error messages:"), $this);?>

<pre><?php echo $this->_tpl_vars['test']['message']; ?>
</pre>
<?php endif;  endif; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</div>
<?php endif; ?>
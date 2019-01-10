<?php /* Smarty version 2.6.16, created on 2008-08-07 11:16:39
         compiled from gallery:modules/core/templates/AdminMaintenance.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'gallery:modules/core/templates/AdminMaintenance.tpl', 34, false),)), $this); ?>
<div class="gbBlock gcBackground1">
<h2> <?php echo $this->_reg_objects['g'][0]->text(array('text' => 'System Maintenance'), $this);?>
 </h2>
</div>
<?php if (isset ( $this->_tpl_vars['status']['run'] )): ?>
<div class="gbBlock">
<?php ob_start(); ?><b><?php echo $this->_reg_objects['g'][0]->text(array('text' => $this->_tpl_vars['AdminMaintenance']['tasks'][$this->_tpl_vars['status']['run']['taskId']]['title'],'l10Domain' => $this->_tpl_vars['AdminMaintenance']['tasks'][$this->_tpl_vars['status']['run']['taskId']]['l10Domain']), $this);?>
</b><?php $this->_smarty_vars['capture']['taskTitle'] = ob_get_contents(); ob_end_clean();  if (( $this->_tpl_vars['status']['run']['success'] )): ?>
<h2 class="giSuccess">
<?php echo $this->_reg_objects['g'][0]->text(array('text' => "Completed %s task successfully.",'arg1' => $this->_smarty_vars['capture']['taskTitle']), $this);?>

</h2>
<?php else: ?>
<h2 class="giError">
<?php echo $this->_reg_objects['g'][0]->text(array('text' => "The %s task failed to complete successfully.",'arg1' => $this->_smarty_vars['capture']['taskTitle']), $this);?>

</h2>
<?php endif; ?>
</div>
<?php endif; ?>
<div class="gbBlock">
<table class="gbDataTable" width="100%">
<tr>
<th> <?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Task name'), $this);?>
 </th>
<th> <?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Last run'), $this);?>
 </th>
<th> <?php echo $this->_reg_objects['g'][0]->text(array('text' => "Success/Fail"), $this);?>
 </th>
<th> <?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Action'), $this);?>
 </th>
</tr>
<?php $_from = $this->_tpl_vars['AdminMaintenance']['tasks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['taskId'] => $this->_tpl_vars['info']):
 echo smarty_function_cycle(array('values' => "gbEven,gbOdd",'assign' => 'rowClass'), $this);?>

<tr class="<?php echo $this->_tpl_vars['rowClass']; ?>
">
<td>
<span id="task-<?php echo $this->_tpl_vars['taskId']; ?>
-toggle"
class="giBlockToggle gcBackground1 gcBorder2"
style="border-width: 1px"
onclick="BlockToggle('task-<?php echo $this->_tpl_vars['taskId']; ?>
-description', 'task-<?php echo $this->_tpl_vars['taskId']; ?>
-toggle', 'table-row')"><?php if (! isset ( $this->_tpl_vars['status']['run'] ) || $this->_tpl_vars['status']['run']['taskId'] != $this->_tpl_vars['taskId']): ?>+<?php else: ?>-<?php endif; ?></span>
<?php echo $this->_reg_objects['g'][0]->text(array('text' => $this->_tpl_vars['info']['title'],'l10Domain' => $this->_tpl_vars['info']['l10Domain']), $this);?>

</td><td>
<?php if (isset ( $this->_tpl_vars['info']['timestamp'] )):  echo $this->_reg_objects['g'][0]->date(array('timestamp' => $this->_tpl_vars['info']['timestamp'],'style' => 'datetime'), $this);?>

<?php else:  echo $this->_reg_objects['g'][0]->text(array('text' => 'Not run yet'), $this);?>

<?php endif; ?>
</td><td>
<?php if (isset ( $this->_tpl_vars['info']['success'] )):  if ($this->_tpl_vars['info']['success']): ?>
<div class="giSuccess">
<?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Success'), $this);?>

</div>
<?php else: ?>
<div class="giError">
<?php echo $this->_reg_objects['g'][0]->text(array('text' => 'Failed'), $this);?>

</div>
<?php endif;  else:  echo $this->_reg_objects['g'][0]->text(array('text' => 'Not run yet'), $this);?>

<?php endif; ?>
</td><td>
<a href="<?php echo $this->_reg_objects['g'][0]->url(array('arg1' => "controller=core.AdminMaintenance",'arg2' => "form[action][runTask]=1",'arg3' => "taskId=".($this->_tpl_vars['taskId'])), $this);?>
"<?php if (isset ( $this->_tpl_vars['info']['confirmRun'] )): ?> onclick="return confirm('<?php echo $this->_reg_objects['g'][0]->text(array('text' => $this->_tpl_vars['info']['title'],'forJavascript' => 1), $this);?>
: <?php echo $this->_reg_objects['g'][0]->text(array('text' => "Are you sure?",'forJavascript' => 1), $this);?>
')"
<?php endif; ?>><?php echo $this->_reg_objects['g'][0]->text(array('text' => 'run now'), $this);?>
</a>
</td>
</tr>
<tr class="<?php echo $this->_tpl_vars['rowClass']; ?>
" id="task-<?php echo $this->_tpl_vars['taskId']; ?>
-description"
<?php if (! isset ( $this->_tpl_vars['status']['run'] ) || $this->_tpl_vars['status']['run']['taskId'] != $this->_tpl_vars['taskId']): ?>style="display: none"<?php endif; ?>>
<td colspan="4">
<?php echo $this->_reg_objects['g'][0]->text(array('text' => $this->_tpl_vars['info']['description'],'l10Domain' => $this->_tpl_vars['info']['l10Domain']), $this);?>

<?php if (! empty ( $this->_tpl_vars['info']['details'] )): ?>
<p class="giDescription"> <?php echo $this->_reg_objects['g'][0]->text(array('text' => "Last Run Details:"), $this);?>
 </p>
<p class="giInfo">
<?php $_from = $this->_tpl_vars['info']['details']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['text']):
 echo $this->_tpl_vars['text']; ?>
 <br/>
<?php endforeach; endif; unset($_from); ?>
</p>
<?php endif; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</div>
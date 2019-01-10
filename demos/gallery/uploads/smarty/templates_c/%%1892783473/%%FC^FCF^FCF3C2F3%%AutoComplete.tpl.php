<?php /* Smarty version 2.6.16, created on 2008-08-07 11:15:33
         compiled from gallery:modules/core/templates/AutoComplete.tpl */ ?>
<?php if ($this->_tpl_vars['callCount'] == 1): ?>
<script type="text/javascript" src="<?php echo $this->_reg_objects['g'][0]->url(array('href' => "lib/yui/yahoo-min.js"), $this);?>
"></script>
<script type="text/javascript" src="<?php echo $this->_reg_objects['g'][0]->url(array('href' => "lib/yui/dom-min.js"), $this);?>
"></script>
<script type="text/javascript" src="<?php echo $this->_reg_objects['g'][0]->url(array('href' => "lib/yui/event-min.js"), $this);?>
"></script>
<script type="text/javascript" src="<?php echo $this->_reg_objects['g'][0]->url(array('href' => "lib/yui/connection-min.js"), $this);?>
"></script>
<script type="text/javascript" src="<?php echo $this->_reg_objects['g'][0]->url(array('href' => "lib/yui/animation-min.js"), $this);?>
"></script>
<script type="text/javascript" src="<?php echo $this->_reg_objects['g'][0]->url(array('href' => "lib/yui/autocomplete-min.js"), $this);?>
"></script>
<script type="text/javascript" src="<?php echo $this->_reg_objects['g'][0]->url(array('href' => "lib/javascript/AutoComplete.js"), $this);?>
"></script>
<?php endif; ?>
<script type="text/javascript">
// <![CDATA[
YAHOO.util.Event.addListener(
this, 'load',
function(e, data) { autoCompleteAttach(data[0], data[1]); },
['<?php echo $this->_tpl_vars['element']; ?>
', '<?php echo $this->_tpl_vars['url']; ?>
']);
// ]]>
</script>
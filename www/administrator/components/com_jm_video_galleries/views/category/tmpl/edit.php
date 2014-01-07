<?php
/**
 * @package     com_jm_video_galleries
 * @version     1.0.0
 * Author - JoomlaMan http://www.joomlaman.com
 * Copyright (C) 2012 - 2013 JoomlaMan.com. All Rights Reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 * Websites: http://www.JoomlaMan.com
 * Support: support@joomlaman.com
*/
// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_jm_video_galleries/assets/css/jm_video_galleries.css');
?>
<script type="text/javascript">
    function getScript(url,success) {
        var script = document.createElement('script');
        script.src = url;
        var head = document.getElementsByTagName('head')[0],
        done = false;
        // Attach handlers for all browsers
        script.onload = script.onreadystatechange = function() {
            if (!done && (!this.readyState
                || this.readyState == 'loaded'
                || this.readyState == 'complete')) {
                done = true;
                success();
                script.onload = script.onreadystatechange = null;
                head.removeChild(script);
            }
        };
        head.appendChild(script);
    }
    getScript('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',function() {
        js = jQuery.noConflict();
        js(document).ready(function(){
            Joomla.submitbutton = function(task)
            {
                if (task == 'category.cancel') {
                    Joomla.submitform(task, document.getElementById('category-form'));
                }
                else{                    
                    if (task != 'category.cancel' && document.formvalidator.isValid(document.id('category-form'))) {                        
                        Joomla.submitform(task, document.getElementById('category-form'));
                    }
                    else {
                        alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
                    }
                }
            }
        });
    });
</script>
<form action="<?php echo JRoute::_('index.php?option=com_jm_video_galleries&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="category-form" class="form-validate">
    <div class="row-fluid">
		<div class="span12 form-horizontal">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_JM_VIDEO_GALLERIES_LEGEND_CATEGORY'); ?></legend>
            <div class="row-fluid">
				<div class="span10">
					<div class="control-group" style="display:none;">
							<?php echo $this->form->getLabel('id'); ?>
							<div class="controls">
								<?php echo $this->form->getInput('id'); ?>
							</div>
						</div>
						<div class="control-group">
							<?php echo $this->form->getLabel('title'); ?>
							<div class="controls">
								<?php echo $this->form->getInput('title'); ?>
							</div>
						</div>
						<div class="control-group">
							<?php echo $this->form->getLabel('state'); ?>
							<div class="controls">
								<?php echo $this->form->getInput('state'); ?>
							</div>
						</div>
						<div class="control-group">
							<?php echo $this->form->getLabel('image'); ?>
							<div class="controls">
								<?php echo $this->form->getInput('image'); ?>
							</div>
						</div> 
						<div class="control-group">
							<?php echo $this->form->getLabel('description'); ?>
							<div class="controls">
								<?php echo $this->form->getInput('description'); ?>
							</div>
						</div>
						<div class="control-group" style="display: none;">
							<?php echo $this->form->getLabel('created_by'); ?>
							<div class="controls">
								<?php echo $this->form->getInput('created_by'); ?>
							</div>
						</div>
				</div>
			</div>
        </fieldset>
    </div>
    </div>
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
    <div class="clr"></div>
    <style type="text/css">
        /* Temporary fix for drifting editor fields */
        .adminformlist li {
            clear: both;
        }
    </style>
</form>

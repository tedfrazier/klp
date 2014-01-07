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
$document->addScript('components/com_jm_video_galleries/assets/js/jquery-1.9.1.min.js');
$document->addScript('components/com_jm_video_galleries/assets/js/jyoutube.js');
$document->addScript('components/com_jm_video_galleries/assets/js/make_alias.js');
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
                if (task == 'video.cancel') {
                    Joomla.submitform(task, document.getElementById('video-form'));
                }
                else{
                    if (task != 'video.cancel' && document.formvalidator.isValid(document.id('video-form'))) {
                        js = jQuery.noConflict();
						js(document).ready(function(){
							if(js('#jform_cat_ids option:selected').length == 0){
								js("#jform_cat_ids option[value=0]").attr('selected','selected');
							}
						});
						Joomla.submitform(task, document.getElementById('video-form'));
                    }
                    else {
                        alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
                    }
				}
			}
        });
    });
</script>
<form action="<?php echo JRoute::_('index.php?option=com_jm_video_galleries&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="video-form" class="form-validate">
    <div class="row-fluid">
		<div class="span10 form-horizontal">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_JM_VIDEO_GALLERIES_LEGEND_VIDEO'); ?></legend>
				<div class="row-fluid">
					<div class="span10">
						<div class="control-group">
							<?php echo $this->form->getLabel('title'); ?>
							<div class="controls">
								<?php echo $this->form->getInput('title'); ?>
							</div>
						</div>
						<div class="control-group">
							<?php echo $this->form->getLabel('alias'); ?>
							<div class="controls">
								<?php echo $this->form->getInput('alias'); ?>
							</div>
						</div>
						<div class="control-group">
							<?php echo $this->form->getLabel('date_created'); ?>
							<div class="controls">
								<?php echo $this->form->getInput('date_created'); ?>
							</div>
						</div>
						<div class="control-group">
							<?php echo $this->form->getLabel('video_type'); ?>
							<div class="controls">
								<?php echo $this->form->getInput('video_type'); ?>
							</div>
						</div>
						<div class="control-group">
							<?php echo $this->form->getLabel('url'); ?>
							<div class="controls">
								<?php echo $this->form->getInput('url'); ?>
								<button value="" name="genthum" id="genthum" class="" style="border-radius: 12px;background: #f4f4f4;"><?php echo JText::_('COM_JM_VIDEO_GALLERIES_VIDEO_BUTTON_GENERATOR_THUMBNAIL');?></button>
								<img src="" style="width:132px" id="jm_thumb"/>
							</div>
						</div>
						<div class="control-group">
							<?php echo $this->form->getLabel('image'); ?>
							<div class="controls">
								<?php echo $this->form->getInput('image'); ?>
							</div>
						</div>
						<div class="control-group">
							<?php echo $this->form->getLabel('state'); ?>
							<div class="controls">
								<?php echo $this->form->getInput('state'); ?>
							</div>
						</div>
						<div class="control-group" style="display: none;">
							<?php echo $this->form->getLabel('created_by'); ?>
							<div class="controls">
								<?php echo $this->form->getInput('created_by'); ?>
							</div>
						</div>
						<div class="control-group">
							<?php echo $this->form->getLabel('cat_ids'); ?>
							<div class="controls">
								<?php echo $this->form->getInput('cat_ids'); ?>
							</div>
						</div>
						<div class="control-group">
							<?php echo $this->form->getLabel('description'); ?>
							<div class="controls">
								<?php echo $this->form->getInput('description'); ?>
							</div>
						</div>
						<div class="control-group" style="display:none">
							<?php echo $this->form->getLabel('date_created'); ?>
							<div class="controls">
								<input id="jform_date_created" type="text" value="<?php echo date("Y-m-d"); ?>" name="jform[date_created]">
							</div>
						</div>
					</div>
				</div>
			<?php
				foreach((array)$this->item->cat_ids as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="cat_ids" name="jform[cat_idshidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>
			<script type="text/javascript">
				window.onload = function(){
					jQuery.noConflict();
					jQuery('input:hidden.cat_ids').each(function(){
						var name = jQuery(this).attr('name');
						if(name.indexOf('cat_idshidden')){
							jQuery('#jform_cat_ids option[value="'+jQuery(this).val()+'"]').attr('selected',true);
						}
					});
				}
				jQuery('#jform_title').keyup(function(){
					var current_value=jQuery('#jform_title').val();
					var current_length=current_value.length;
					if(current_length){
						jQuery('#jform_alias').val(vt_safe_vietnamese(current_value));
					}
				});
				jQuery(document).ready(function(){
					// Get youtube video thumbnail on user click
					var url = '';
					jQuery('#genthum').click(function(){
						var data={url:jQuery('#jform_url').val()};
            jQuery.ajax({
              url: "index.php?option=com_jm_video_galleries&view=video&format=ajax",
              type:'POST',
              data: data,
              success: function(data){
                jQuery('#jm_thumb').attr('src','<?php print JURI::root(TRUE);?>/'+data);
								jQuery('#jform_image').val(data);
              }
            });
            return false;
					});
				});
			</script>
        </fieldset>
		</div>
    </div>
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
    <div class="clr"></div>
</form>

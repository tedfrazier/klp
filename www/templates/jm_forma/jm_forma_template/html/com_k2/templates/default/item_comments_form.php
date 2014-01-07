<?php
/**
 * @version		$Id: item_comments_form.php 1618 2012-09-21 11:23:08Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

?>

<h3 class="entry-title"><?php echo JText::_('K2_LEAVE_A_COMMENT') ?></h3>

<?php if($this->params->get('commentsFormNotes')): ?>
<p class="itemCommentsFormNotes">
	<?php if($this->params->get('commentsFormNotesText')): ?>
	<?php echo nl2br($this->params->get('commentsFormNotesText')); ?>
	<?php else: ?>
	<?php echo JText::_('K2_COMMENT_FORM_NOTES') ?>
	<?php endif; ?>
</p>
<?php endif; ?>

<form action="<?php echo JURI::root(true); ?>/index.php" method="post" id="comment-form" class="form-validate">
    <div class="itemCommentInfo row-fluid  clearfix">
        <div class="span6">
            <input class="inputbox" type="text" name="userName" id="userName" placeholder="<?php echo JText::_('K2_NAME'); ?> *"/>
        </div>
    </div>
	<div class="row-fluid">
		<div class="span6"> 
            <input class="inputbox" type="text" name="commentEmail" id="commentEmail" placeholder="<?php echo JText::_('K2_EMAIL'); ?> *" />
        </div>
	</div>
	<div class="row-fluid">
		<div class="itemCommentSiteUrl span6 clearfix">
			<input class="inputbox" type="text" name="commentURL" id="commentURL" placeholder="<?php echo JText::_('K2_WEBSITE_URL'); ?> *"/>
		</div>
    </div>
	<div class="row-fluid">
    <div class="itemCommentInputBox span9 clearfix">
        <textarea rows="20" cols="10" class="inputbox" placeholder="<?php echo JText::_('JM_K2_ENTER_YOUR_MESSAGE_HERE'); ?>" name="commentText" id="commentText"></textarea>
    </div>
	</div>
    <?php if($this->params->get('recaptcha') && $this->user->guest): ?>
        <div class="clearfix">
            <label class="formRecaptcha"><?php echo JText::_('K2_ENTER_THE_TWO_WORDS_YOU_SEE_BELOW'); ?></label>
            <div id="recaptcha"></div>
        </div>
    <?php endif; ?>
    <div class="k2submit clerfix">
        <div class="tick"></div>
	    <input type="submit" class="btn btn-readmore" id="jm-submitCommentButton" value="<?php echo JText::_('JM_K2_SUBMIT_COMMENT'); ?>" />
    </div>
	<span id="formLog"></span>

	<input type="hidden" name="option" value="com_k2" />
	<input type="hidden" name="view" value="item" />
	<input type="hidden" name="task" value="comment" />
	<input type="hidden" name="itemID" value="<?php echo JRequest::getInt('id'); ?>" />
	<?php echo JHTML::_('form.token'); ?>
</form>
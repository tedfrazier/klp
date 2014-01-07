<?php
/* * --------------------------------------------------------------------
  # Package - JoomlaMan JM Login
  # Version 1.0
  # --------------------------------------------------------------------
  # Author - JoomlaMan http://www.joomlaman.com
  # Copyright © 2012 - 2013 JoomlaMan.com. All Rights Reserved.
  # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
  # Websites: http://www.JoomlaMan.com
  ---------------------------------------------------------------------* */

// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<div id="jmregister" class="jmregister jm-tab-content" >
    <form action="<?php print JURI::root(true)?>/modules/mod_jmlogin/ajax_register.php" method="POST" class="form-horizontal" id="jm-form-register">
        <input type="hidden" name="link-base" value="<?php $link = (JURI::base()); echo $link; ?>" />
        <input type="hidden" name="register" value="register" />
        <div class="alert_register" style="display:none">Please waiting ...</div>
        <div class="control-group name">
            <div class="controls-label">
                <div class="jm-label-wrap clearfix">
                    <label for="register_name"><?php echo $field_name; ?></label>
                </div>
            </div>
            <div class="controls-content">
                <div class="jm-input-wrap clearfix">
                    <input type="text" id="register_name" name="register_name" placeholder="<?php echo $field_name; ?>"/>
                    <span class="help-inline span_name"></span>
                </div>
            </div>
        </div>
        <div class="control-group username">
            <div class="controls-label">
                <div class="jm-label-wrap clearfix">
                    <label for="register_username"><?php echo $field_username; ?></label>
                </div>
            </div>
            <div class="controls-content">
                <div class="jm-input-wrap clearfix">
                    <input type="text" id="register_username" name="register_username" placeholder="<?php echo $field_username; ?>"/>
                    <span class="help-inline span_username"></span>
                </div>
            </div>
        </div>
        <div class="control-group pass">
            <div class="controls-label">
                <div class="jm-label-wrap clearfix">
                    <label for="register_pass"><?php echo $field_password; ?></label>
                </div>
            </div>
            <div class="controls-content">
                <div class="jm-input-wrap clearfix">
                    <input type="password" id="register_pass" name="register_pass" placeholder="<?php echo $field_password; ?>" />
                    <span class="help-inline span_pass"></span>
                </div>
            </div>
        </div>
        <div class="control-group pass_verify">
            <div class="controls-label">
                <div class="jm-label-wrap clearfix">
                    <label for="register_pass_verify"><?php echo $field_verifypassword; ?></label>
                </div>
            </div>
            <div class="controls-content">
                <div class="jm-input-wrap clearfix">
                    <input type="password" id="register_pass_verify" name="register_pass_verify" placeholder="<?php echo $field_verifypassword; ?>"/>
                    <span class="help-inline span_pass_verify"></span>
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls-label">
                <div class="jm-label-wrap clearfix">
                    <label for="regisrer_email"><?php echo $field_email; ?></label>
                </div>
            </div>
            <div class="controls-content">
                <div class="jm-input-wrap clearfix">
                    <input type="text" id="register_email" name="register_email" placeholder="<?php echo $field_email; ?>" onchanged="validateEmail()"/>
                    <span class="help-inline span_email"></span>
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls-label">
                <div class="jm-label-wrap-cb clearfix">
                    <label for="register_email_verify"><?php echo $field_verifyemail; ?></label>
                </div>
            </div>
            <div class="controls-content">
                <div class="jm-input-wrap clearfix">
                    <input type="text" id="register_email_verify" name="register_email_verify" placeholder="<?php echo $field_verifyemail; ?>" />
                    <span class="help-inline span_email_verify"></span>
                </div>
            </div>
        </div>
        <div class="control-group">
		<?if($show_recaptcha):?>
            <div class="jm-wrap">
				<?php echo recaptcha_get_html($publickey); ?>
            </div>
		<?endif;?>
            <div class="jm-wrap jm-input-wrap-cb clearfix">
                <label class="jm-wrap" for="">Filds width(*) are required</label>
            </div>
        </div>
        <div class="control-group">
            <div class="controls-content">
                <button type="submit" id="jm-register-btn" name="register" value="REGISTER" class="btn-jm-submit"><?php echo $btn_register; ?></button>
            </div>
        </div>
    </form>
</div>
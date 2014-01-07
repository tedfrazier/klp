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
<div id="jmlogin" class="jmlogin jm-tab-content" >
    <form action="<?php print JURI::root(true)?>/modules/mod_jmlogin/ajax_login.php" method="POST" class="form-horizontal" id="jm-login-form">
        <input type="hidden" name="login" value="login" />
        <div class="alert-login" style="display:none;margin-bottom: 12px;"></div>
        <div class="control-group">
            <div class="controls-label">
                <div class="jm-label-wrap clearfix">
                    <label for="inputUser"><?php echo $field_username; ?></label>
                </div>
            </div>
            <div class="controls-content">
                <div class="jm-input-wrap clearfix">
                    <input type="text" id="login_user" name="username" placeholder="<?php echo $field_username; ?>"/>
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls-label">
                <div class="jm-label-wrap clearfix">
                    <label for="login_pass"><?php echo $field_password; ?></label>
                </div>
            </div>
            <div class="controls-content">
                <div class="jm-input-wrap clearfix">
                    <input type="password" id="login_pass" name="password" placeholder="<?php echo $field_password; ?>"/>
                </div>
            </div>
        </div>
        <?php if ($remember_me): ?>
            <div class="control-group">
                <div class="controls-label">
                    <div class="jm-label-wrap clearfix">
                        <label for="modlgn-remember"><?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?></label>
                    </div>
                </div>
                <div class="controls-content">
                    <div class="jm-input-wrap-cb clearfix">
                        <input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"/>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="control-group">
            <div class="controls-content">
                <input type="submit" name="login" id="jm-login-btn" class="btn-jm-submit" value="<?php echo $btn_sign_in; ?>"/>
            </div>
        </div>
        <div class="im-login-footer">
            <a class="float-left" href="#jmmodal" tab="#regain_password" data-tab="jmtab" data-toggle="jmmodal"><?php echo JText::_("Forgot password?"); ?></a>
            <a class="float-right" href="#jmmodal" tab="#jmregister" data-tab="jmtab" data-toggle="jmmodal"><?php echo JText::_("New Account Singup"); ?></a>
            <div class="clear"></div>
        </div>
        <input type="hidden" value="com_users" name="option" />
        <input type="hidden" value="user.login" name="task" />
        <?php
        if ($login_redirect <> "") {
            $menuItem = $menu->getItem($login_redirect);
            ?>
            <input type="hidden" name="return" value="<?php echo (JRoute::_($menuItem->link)); ?>" />
            <?php
        }
        ?>
        <?php echo JHtml::_('form.token'); ?>
    </form>
    <div class="jm-login-footer">
        <span class="float-left"><?php echo JText::_('Or sign with'); ?></span>
        <a class="social float-right" herf="#"><img src="<?php echo JURI::base(true) . '/modules/mod_jmlogin/assets/images/google.png'; ?>"/></a>
        <a class="social float-right" herf="#"><img src="<?php echo JURI::base(true) . '/modules/mod_jmlogin/assets/images/twitter.png'; ?>"/></a>
        <a class="social float-right" herf="#"><img src="<?php echo JURI::base(true) . '/modules/mod_jmlogin/assets/images/facebook.png'; ?>"/></a>
        <div class="clear"></div>
    </div>
</div>
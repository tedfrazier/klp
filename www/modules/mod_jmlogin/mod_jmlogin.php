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
// include the helper file
require_once( dirname(__FILE__) . DS . 'helper.php' );
//params
$label_login = $params->get('tag_login_modal');
$show_recaptcha = $params->get('show_recaptcha',0);
$show_close_btn = $params->get('show_close_btn',true);
$modal_scroll = $params->get('modal_scroll',true);
$modal_width = $params->get('modal_width',400);
$modal_height = $params->get('modal_height',390);
$label_register = $params->get('tag_register_modal');
$label_regain_password = $params->get('tag_regain_password_modal');
$field_name = $params->get('field_name');
$field_username = $params->get('field_username');
$field_password = $params->get('field_password');
$field_verifypassword = $params->get('field_verifypassword');
$field_email = $params->get('field_email');
$field_verifyemail = $params->get('field_verifyemail');
$btn_sign_in = $params->get('btn_sign_in');
$btn_register = $params->get('btn_register');
$btn_regain_password = $params->get('btn_regain_password');
$load_jquery = $params->get('loadJquery');
$align_option = $params->get('align_option');
$login_redirect = $params->get('login');
$logout_redirect = $params->get('logout');
$publickey = $params->get('recaptcha_public', '6LfSV9MSAAAAAFj0hZMcuGtMD7drzb7zhvrmQqnf');
$private_key = $params->get('recaptcha_private', '6LfSV9MSAAAAAPBf64L7fmC_uii-EKza_98qKpG3');
$name_display = $params->get('name');
$register_tab = $params->get('enabled_registration_tab');
$error_invalid = $params->get('error_invalid_username_or_password', 'Invalid username or password');
$msg_username = $params->get('error_existing_username_register', 'Error: This existing username.');
$msg_email = $params->get('error_existing_email_register', 'Error: This existing email.');
$captcha = $params->get('error_wrong_capcha_register', 'Error: Wrong capcha');
$success = $params->get('mess_successfully_register_register', 'Successfully register, check mail (spam) activation account.');
$nexist = $params->get('mess_account_not_exists_regainpass', 'Note: Account not exists');
$check = $params->get('mess_check_mail_regainpass', 'Note: Please check mail to retrieve your password.');
require_once JPATH_SITE . '/modules/mod_jmlogin/assets/recapcha/recaptchalib.php';
$login = new modJmloginHelper();
$login = $login->getLogin($params);
$doc = JFactory::getDocument();
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
$custom_css = JPATH_SITE . '/templates/' . modJmloginHelper::getTemplate() . '/css/' . $module->module.'_'.$params->get('jmlogin_layout', 'default') . '.css';
if (file_exists($custom_css)) {
    $doc->addStylesheet(JURI::base(true) . '/templates/' . modJmloginHelper::getTemplate() . '/css/' . $module->module.'_'.$params->get('jmlogin_layout', 'default') . '.css');
} else {
    $doc->addStylesheet(JURI::base(true) . '/modules/mod_jmlogin/assets/css/mod_jmlogin_'.$params->get('jmlogin_layout', 'default').'.css');
}
require JModuleHelper::getLayoutPath('mod_jmlogin', $params->get('jmlogin_layout', 'default'));
?>
<!--Layout:Dropdown-->
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
$document = JFactory::getDocument();
$main = JFactory::getApplication();
$menu = $main->getMenu();
$style = '
.controls-label{
     text-align: ' . $align_option . ';
}
';
$document->addStyleDeclaration($style);
if ($load_jquery == 1) {
    $document->addScript(JURI::base(true) . '/modules/mod_jmlogin/assets/js/jquery-1.8.3.js');
}
$document->addStyleSheet(JURI::base(true) . '/modules/mod_jmlogin/assets/css/scrollbar.css');
$user = & JFactory::getUser();
$name = !$user->guest;
$remember_me = $params->get('jmlogin-remember-me', 0);
?>
<script type="text/javascript" src="<?php echo JURI::base(true).'/modules/mod_jmlogin/assets/js/jquery.tinyscrollbar.min.js';?>"></script>
<script type="text/javascript" src="<?php echo JURI::base(true).'/modules/mod_jmlogin/assets/js/dropdown.js';?>"></script>
<script type="text/javascript" src="<?php echo JURI::base(true).'/modules/mod_jmlogin/assets/js/jmtab_dropdown.js';?>"></script>
<!-- START Jm Login MODULE -->
<div class="moduletable<?php echo $params->get('moduleclass_sfx'); ?>">
    <?php if ($name) { ?>
        <div class="btn-jm-group" > 
			<div class='jmlogin_dropdown_before'> 
			
			</div>
			<div class='jmlogin_dropdown_after'>
				<div class='jmlogin_username_wrap'>
					<a class='jmlogin_username' href="javascript:void(0);"><?php echo ($name_display) ? $user->name : $user->username; ?></a>
				</div>
				<div class='jmlogin_logout_btn_wrap'>
					<a class='jmlogin_logout_btn' href="javascript:void(0);" onclick="jQuery('.form_logout').submit();">LOGOUT</a>
				</div>
			</div>
			
            <ul class="jmlogin_form_logout">
                <li>
                    <form class="form_logout" action="index.php" method="POST">
                        <input type="submit" name="Submit" class="button" value="<?php echo JText::_('Logout'); ?>" />
                        <input type="hidden" name="option" value="com_users" />
                        <input type="hidden" name="task" value="user.logout" />
                        <?php
                        if ($logout_redirect <> "") {
                            $menuItem = $menu->getItem($logout_redirect);
                            ?><input type="hidden" name="return" value="<?php echo base64_encode(JRoute::_($menuItem->link)); ?>" /><?php
                }
                        ?>
                        <?php echo JHtml::_('form.token'); ?>
                    </form>
                </li>
            </ul>
        </div>
		<div class='clear'></div>
    <?php } else { ?>
        <div class="btn-jm-group" id="btn-action">
            <a class="jm-login-link-modal" href="#jmmodal" tab="#jmlogin" data-tab="jmtab" data-toggle="jmmodal"><?php echo $label_login; ?></a>
           <?php if ($register_tab): ?>
                <a class="jm-login-link-modal" href="#jmmodal" tab="#jmregister" data-tab="jmtab" data-toggle="jmmodal"><?php echo $label_register; ?></a>
            <?php endif; ?>
            <a class="jm-login-link-modal regain_password" href="#jmmodal" tab="#regain_password" data-tab="jmtab" data-toggle="jmmodal"><?php echo $label_regain_password; ?></a>
            <div class="arrow-up"></div>
        </div>
    <?php } ?>
    <div id="jmmodal" class="jm-tabs-content jmmodal" modal-width="400" modal-height="390" modal-close="true" modal-scroll="true">
        <div id="jm-login-wrap">
            <div class="tab-outer">
                <span id="tab-jmlogin" data-tab="jmtab" tab="#jmlogin" class="tab-inner active"><?php echo "User Login"; ?></span>
                <span id="tab-jmregister" data-tab="jmtab" tab="#jmregister" class="tab-inner"><?php echo $label_register; ?></span>
                <span id="tab-regain_password" data-tab="jmtab" tab="#regain_password" class="tab-inner"><?php echo $label_regain_password; ?></span>
            </div>
            <div id="tab-content"  class="modal-body">
                <!-- Start login -->
                <?php include("default_login.php"); ?>
                <!-- End login -->
                <!-- Start  register -->
                <?php
                if ($register_tab) {
                    include("default_register.php");
                }
                ?>
                <!-- End  register -->
                <!-- Start  regain password -->
				<?php include("default_regain_password.php"); ?>
                <!-- End  regain password -->
            </div>
        </div>		
    </div>
	<div class="jmtab_active"></div>
</div>
<!-- END Jm Login MODULE -->
<script type="text/javascript">
    $jm=jQuery.noConflict();
    $jm(document).ready(function(){
        $jm('.jmlogin_username').unbind('click').click(function(){
			if($jm(this).hasClass('active')){
				$jm(this).removeClass('active');
				$jm('.jmlogin_logout_btn_wrap').slideUp(500); 
			}else{
				$jm(this).addClass('active');
				$jm('.jmlogin_logout_btn_wrap').slideDown(500);
			}
        })
		
		$jm(document).unbind('click').click(function(e){
			var target = jQuery(e.target).attr('class');
			if(target=="jmlogin_username active") return;
			if($jm('.jmlogin_username').hasClass('active')){
				$jm('.jmlogin_username').removeClass('active');
				$jm('.jmlogin_logout_btn_wrap').slideUp(500); 
			}
		});
    });
</script>
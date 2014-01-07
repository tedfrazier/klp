<div id="regain_password" class="regain_password jm-tab-content">
	<form action="" method="POST" class="form-horizontal" id="jm-form-repassword">
		<input type="hidden" name="regainPass" value="regainPass" />
		<div class="alert-repassword" style="padding: 5px;margin-bottom: 12px;color: #990033; display:none">Note: Please waiting ...</div>
		<div class="control-group">
			<div class="controls-label">
				<div class="jm-label-wrap clearfix">
					<label for="inputEmail"><?php echo JText::_("Please choose Email or Username");?></label>
				</div>
			</div>
			<div class="controls-content">
				<span class="float-left"><input type="radio" name="selecttype" value="email" checked="true" /><?php echo JText::_("Email");?></span>
				<span class="float-right"><input type="radio" name="selecttype" value="username" /><?php echo JText::_("Username");?> </span>
				<div class="clear"></div>
			</div>
			<div class="control-group typeselect" id="username_select" style="display: none;">
				<div class="controls-label">
					<div class="jm-label-wrap clearfix">
						<label for="inputUname"><?php echo $field_username; ?></label>
					</div>
				</div>
				<div class="controls-content">
					<div class="jm-input-wrap clearfix">
						<input type="text" id="re_uname" name="re_uname" placeholder="<?php echo $field_username; ?>"/>
					</div>
				</div>
			</div>

			<div class="control-group typeselect" id="email_select">
				<div class="controls-label">
					<div class="jm-label-wrap clearfix">
						<label for="inputEmail"><?php echo $field_email; ?></label>
					</div>
				</div>
				<div class="controls-content">
					<div class="jm-input-wrap clearfix">
						<input type="text" id="re_inputEmail" name="remail_repass" placeholder="<?php echo $field_email; ?>" onchange="validateEmail()"/>
					</div>
				</div>
			</div>
			<div>
				<input type="hidden" name="nexist" value="<?php echo ($nexist);?>" />
			</div>
			<div class="control-group">
				<div class="controls-content">
					<?php echo JHTML::_('form.token');?>
					<button class="btn-jm-submit" type="submit" id="repassword-btn" name="repassword" value="REPASSWORD"><?php echo $btn_regain_password; ?></button>
				</div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
$jm=jQuery.noConflict();
function validateEmail(){
	var emailaddress = $jm('#re_inputEmail').val();
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	$jm('.alert-repassword').text('').show();
	if(!emailReg.test(emailaddress)) {
		$jm('.alert-repassword').text('You must enter Email accurate').fadeOut(3000);
	}
}
</script>
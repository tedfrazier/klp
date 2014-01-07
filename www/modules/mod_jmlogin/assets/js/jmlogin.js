jQuery(document).ready(function($){
	/*Login*/
	$('form#jm-login-form').submit(function(){
		var $data = {};
		$(this).find('input').each(function(index){
			$data[$(this).attr('name')] = $(this).val();
		})
		$.getJSON(jm_login_base_url+'/modules/mod_jmlogin/ajax_login.php',$data,function(data){
				if(data.status == 'failed'){
					$('.alert_register').text(data.error).show(0);
					setTimeout(function(){$("#jmmodal").JmModal('updateScroll');},1000);
				}else{
					$("#jmmodal").JmModal('hide');
					if(data.redirect!=''){
						window.location = data.redirect;
					}else{
						window.location.reload();
					}
				}
		});
		return false;
	})
	/*Register*/
	$('form#jm-form-register').submit(function(){
		var $data = {};
		$(this).find('input').each(function(index){
			$data[$(this).attr('name')] = $(this).val();
		})
		$.getJSON(jm_login_base_url+'/modules/mod_jmlogin/ajax_register.php',$data,function(data){
				if(data.status == 'failed'){
					$('.alert_register').text(data.error).show(0);
					Recaptcha.reload();
					setTimeout(function(){$("#jmmodal").JmModal('updateScroll');},1000);
				}else{
					$("#jmmodal").JmModal('hide');
				}
		});
		return false;
	})
	/*Repassword*/
	$('form#jm-form-repassword').submit(function(){
		var $data = {};
		$(this).find('input').each(function(index){
			$data[$(this).attr('name')] = $(this).val();
		})
		$.getJSON(jm_login_base_url+'/modules/mod_jmlogin/ajax_repassword.php',$data,function(data){
				if(data.status == 'failed'){
					$('.alert-repassword').text(data.error).show(0);
					setTimeout(function(){$("#jmmodal").JmModal('updateScroll');},1000);
				}else{
					$("#jmmodal").JmModal('hide');
				}
		});
		return false;
	})
	$('input[name="selecttype"]').change(function(){
		$('.typeselect').hide();
		$('#'+$(this).val()+"_select").show();
	})
})
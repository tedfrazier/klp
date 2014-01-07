/* =========================================================
 * jmtab.js v1.0
 * =========================================================
 * Copyright 2013 joomexp.com.
 * Author: nguyencongt3@gmail.com
 * ========================================================= */

!(function ($) {
	$.fn.jmtab = function () {
		this.each(function () {
			var $this = $(this);
			var $id = $this.attr('id');
			$this.addClass('tab-active').show();
			$this.parent().find('div.jm-tab-content').not(this).removeClass('tab-active').hide();
			$('#tab-'+$id).addClass('active');
			$('#tab-'+$id).parent().find('span').not('#tab-'+$id).removeClass('active');
			$("#jmmodal").JmModal('updateScroll');
		});
	};
	
	$(document).ready(function(){
        $('[data-tab="jmtab"]').click(function(){
            var $this = $(this);
			var tab = $this.attr('tab');
			if(tab=="#jmlogin"){
				$left=15;
			}else if(tab=="#jmregister"){
				$left=78;
			}else{
				$left=15;
			}
			$('.arrow-up').css({top:25+'px',display:'block',left:+$left+'px'});
            $($this.attr('tab').toString()).jmtab();
            return false;
        });
    });
 })(jQuery);
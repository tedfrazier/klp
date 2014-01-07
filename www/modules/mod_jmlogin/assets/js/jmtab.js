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
			$this.show();
			$this.parent().find('div.jm-tab-content').not(this).hide();
			$('#tab-'+$id).addClass('active');
			$('#tab-'+$id).parent().find('span').not('#tab-'+$id).removeClass('active');
			//$("#jmmodal").JmModal('updateScroll');
		});
	}; 
	
	$(document).ready(function(){
        $('[data-tab="jmtab"]').click(function(){
            var $this = $(this);
            $($this.attr('tab').toString()).jmtab();
            return false;
        });
    });
 })(jQuery);
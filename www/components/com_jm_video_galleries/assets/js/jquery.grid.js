

!(function ($) { 

  $.fn.JMGrid = function (options) {
    var defaultVal = {
		filter: '',
		sort:'',
		ordering: ordering,
		data_sort: 'name',
		cols: cols,
		margin: 10,
		item: '.item',
		hiddenClass: 'jmhidden'
    };
    var $options = $.extend(defaultVal, options);
	$options.width = $(this).width();
	$options.colstmpl = $options.cols;
	this.each(function () {
    var $this = $(this);
			var $items = $this.find($options.item);
			var rate = $items.width()/$items.height();
			$options.rate = rate;
			gridFilter($this);
			$($options.filter).click(function(){
				var $data_filter = $(this).attr('data-filter');
				if($(this).index()!=0){
					$(this).parent().find('.current').not(this).removeClass('current');
					$(this).addClass('current');
				}
				if($data_filter != null){
					$items.removeClass($options.hiddenClass).not($data_filter).addClass($options.hiddenClass);
				}
				gridFilter($this);
			});

			$($options.sort).click(function(){
				if($(this).index()!=0){
					$(this).parent().find('.current').not(this).removeClass('current');
					$(this).addClass('current');
				}
				var $data_sorting = $(this).attr('data-sorting');
				if($data_sorting){
					$options.data_sort = $data_sorting;
					gridSort($this);
				}
			});
			var resizeable = false;
			var timer = setInterval(function(){resizeable=true},500);
			$(window).resize(function(e){
				if(true){
					gridFilter($this);
					resizeable = false;
				}
			});
    });
	
	function gridFilter($obj){
		var $items = null;
		if($options.hiddenClass != null){
			$items = $obj.find($options.item).not("."+$options.hiddenClass);
		}else{
			$items = $obj.find($options.item);
		}
		animateItems($obj,$items);
	}


	function gridSort($obj){
		var $items = null;
		if($options.hiddenClass != null){
			$items = $obj.find($options.item).not("."+$options.hiddenClass);
		}else{
			$items = $obj.find($options.item);
		}
		$items.sort(compare);
		animateItems($obj,$items);
	}

	

	function compare(a,b) {
		if($options.data_sort=='name'){
			var data_a = $(a).find('.jmvideogalleries_title').text();
			var data_b = $(b).find('.jmvideogalleries_title').text();
		}else if($options.data_sort=='date'){
			var data_a = $(a).find('.jmvideogalleries_date').text();
			var data_b = $(b).find('.jmvideogalleries_date').text(); 
		}
		if($options.ordering=='asc'){
			if (data_a < data_b)
				return -1;
			if (data_a > data_b)
				return 1;
		}else{
			if (data_a > data_b)
				return -1;
			if (data_a < data_b)
				return 1;
		}
		return 0;
	}

	function animateItems($obj,$items){
		if($(window).width()<760){
			$options.cols=1;
		}else{
			$options.cols = $options.colstmpl;
		}
		var width = ($obj.width() - $options.margin * ($options.cols - 1))/$options.cols;
		$items.css({position:'absolute'});
		var $rows = Math.ceil($items.length/$options.cols);
		var height = width/$options.rate * $rows + ($rows-1) * $options.margin;
		$obj.height(height);
		$($items).each(function(index){
			var $col = (index % $options.cols);
			var $row = Math.floor((index)/$options.cols);
			var top = $row * width/$options.rate + $row * $options.margin;
			var left = $col * width + ($col) * $options.margin;
			$(this).css({
			  width: width,
			  top:top, 
			  left:left
			});
		});
	}
  }; 
})(jQuery);
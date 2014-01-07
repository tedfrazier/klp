<?php 
global $jmnewspro_bxslider_load;
$document = JFactory::getDocument();
if (empty($jmnewspro_bxslider_load)) {
  $document->addScript(JURI::root(true) . '/modules/mod_jmnewspro/assets/js/jquery.bxslider.js');
  $jmnewspro_bxslider_load = 1;
}
?>

<div class="itemAuthorRelatedHeader module title-line clearfix">
	<h3 class="header entry-title"><span><?php echo JText::_("JM_K2_RELATED_ITEMS_BY_TAG"); ?></span></h3>
	<div class="itemAuthorRelatedBtn" style="<?php echo (Helix::direction()=='rtl')?'left':'right'; ?>:0;">
		<span id="jm-k2-related-next" class="hasTip" data-original-title="<?php echo JText::_('PREV');?>"></span>
		<span id="jm-k2-related-prev" class="hasTip" data-original-title="<?php echo JText::_('NEXT');?>"></span> 
	</div>
	<div id="jm-k2-related" class="portfolio">
		<div class="jm-k2-related-inner slide-item">
			<?php foreach($this->relatedItems as $key=>$item): ?>
			<div class="k2-related-item">
				<div class="k2RelatedItemInner">
				<?php if($this->item->params->get('itemRelatedImageSize')): ?>
					<img class="itemRelImg" src="<?php echo $item->image; ?>" alt="<?php K2HelperUtilities::cleanHtml($item->title); ?>"/>
				<?php endif; ?>

				<?php if($this->item->params->get('itemRelatedTitle', 1)): ?>
					<div class="k2-related-item-title jmnewsprohover">
						<div class="slide-inner">
							<a class="slide-item-readmore readmore" href="<?php echo $item->link ?>"><?php echo JText::_('+'); ?></a>
						</div>
					</div>
				<?php endif; ?>
				</div>
				
				<?php  if($this->item->params->get('itemRelatedTitle', 1)): ?> 
				<h2 class="itemRelTitle entry-title">
					<a class="itemRelTitle" href="<?php echo $item->link ?>"><?php echo $item->title; ?></a>
				</h2>
				<?php endif; ?>

				<?php if($this->item->params->get('itemRelatedCategory')): ?>
				<div class="itemRelCat"><?php //echo JText::_("K2_IN"); ?> 
					<!-- <a href="<?php echo $item->category->link ?>"></a> -->
					<?php echo $item->category->name; ?>
				</div>
				<?php endif;?>
			</div>
			<?php endforeach;?>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
		var slide = null;
		var backup = $('#jm-k2-related').html();
		var options = {
			slideWidth: 270,
			slideHeight: 203,
			minSlides: 1,
			maxSlides: 4,
			slideMargin: 30,
			responsive:1,
			nextSelector:'#jm-k2-related-next',
			prevSelector:'#jm-k2-related-prev',
			pager: false,
			onSliderLoad: function(){
				jQuery('#jm-k2-related').find('img.itemRelImg').width($('#jm-k2-related').find('.k2RelatedItemInner').width()).height($('#jm-k2-related').find('.k2RelatedItemInner').height());
				jQuery('#jm-k2-related').find('.k2-related-item-title').width($('#jm-k2-related').find('.k2RelatedItemInner').width()).height($('#jm-k2-related').find('.k2RelatedItemInner').height());
				
				jQuery('#jm-k2-related .k2RelatedItemInner').hover(function(){
				jQuery('#jm-k2-related').find('.slide-item-readmore').stop(true,false).animate({'line-height': $('#jm-k2-related').find('.k2RelatedItemInner').height()+'px'},200);
					},function(){
						jQuery('#jm-k2-related').find('.slide-item-readmore').stop(false,true).animate({'line-height': '0'},200);
				});
			}		
		};
		function adjustOptions(options, container_width){
			var _options = {};
			$.extend(_options, options);
			if((_options.slideWidth*_options.maxSlides + (_options.slideMargin*(_options.maxSlides-1))) < container_width){
				_options.slideWidth = (container_width-(_options.slideMargin*(_options.maxSlides-1)))/_options.maxSlides;
			}else{
				_options.maxSlides = Math.floor((container_width-(_options.slideMargin*(_options.maxSlides-1)))/_options.slideWidth);
				_options.slideWidth = (container_width-(_options.slideMargin*(_options.maxSlides-1)))/_options.maxSlides;
			}
			return _options;
		}
		var newoptions = adjustOptions(options,$('#jm-k2-related').width());
		$('#jm-k2-related').find('img.itemRelImg').width(270).height(203);
		slide = $('.jm-k2-related-inner').bxSlider(newoptions);
	});
</script>
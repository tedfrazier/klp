<!--layout:Portfolio 2,order:4-->
<?php
/* * --------------------------------------------------------------------
  # Package - JoomlaMan JMNewsPro
  # Version 1.0.1
  # --------------------------------------------------------------------
  # Author - JoomlaMan http://www.joomlaman.com
  # Copyright © 2012 - 2013 JoomlaMan.com. All Rights Reserved.
  # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
  # Websites: http://www.JoomlaMan.com
  ---------------------------------------------------------------------* */
// no direct access
defined('_JEXEC') or die('Restricted access');
global $jmnewspro_jquery_load;
global $jmnewspro_istope_load;
$document = JFactory::getDocument();
$jmnewspro_include_jquery = $params->get('jmnewspro_include_jquery', 0);
if ($jmnewspro_include_jquery) {
    if(empty($jmnewspro_jquery_load)){
        $document->addScript(JURI::root(true) . '/modules/mod_jmnewspro/assets/js/jquery-1.8.3.js');
        $jmnewspro_jquery_load = 1;
    }
}

$app =& JFactory::getApplication();
$tpl_name = $app->getTemplate();

$document->addScript(JURI::root(true) . '/templates/'.$tpl_name.'/js/jquery.colorbox-min.js');
$document->addStyleSheet(JURI::root(true) . '/templates/'.$tpl_name.'/css/colorbox.css');
if(empty($jmnewspro_istope_load)){
    $document->addScript(JURI::root(true) . '/templates/'.$tpl_name.'/js/jquery.grid.min.js');
    $jmnewspro_istope_load = 1;
}
$jmnewspro_item_width = $params->get('jmnewspro_item_width', 200);
$jmnewspro_item_height = $params->get('jmnewspro_item_height', 200);
$jmnewspro_minslide = $params->get('jmnewspro_minslide', 1);
$jmnewspro_maxslide = $params->get('jmnewspro_maxslide', 3);
$jmnewspro_moveslide = $params->get('jmnewspro_moveslide', 0);
$jmnewspro_slidemargin = $params->get('jmnewspro_slidemargin', 10);
$moduleclass_sfx = $params->get('moduleclass_sfx');
$jmnewspro_show_nav_buttons = $params->get('jmnewspro_show_nav_buttons', 0);
$jmnewspro_show_pager = $params->get('jmnewspro_show_pager', 0);
$jmnewspro_show_title = $params->get('jmnewspro_show_title', 1);
$jmnewspro_show_desc = $params->get('jmnewspro_show_desc', 1);
$jmnewspro_show_image = $params->get('jmnewspro_show_image', 1);
$jmnewspro_show_readmore = $params->get('jmnewspro_show_readmore', 0);
$jmnewspro_readmore_text = $params->get('jmnewspro_readmore_text', 'Read more');
$jmnewspro_hover = $params->get('jmnewspro_hover', 0);
$jmnewspro_pager_position = $params->get('jmnewspro_pager_position', 'bottomright');
$jmnewspro_image_link = $params->get('jmnewspro_image_link', 'bottomright');
$slider_source = $params->get('slider_source', 1);
if($slider_source==1){
	$categories = $params->get('jmnewspro_categories');
	$field = "id,title AS title";
	$field1 = "id";
	$table = "#__categories";
}
elseif($slider_source==3){
	$categories = $params->get('jmnewspro_k2_categories');
	$field = "id,name AS title";
	$field1 = "id";
	$table = "#__k2_categories";
}
else{
	$categories = $params->get('jmnewspro_hikashop_categories');
	$field = "category_id,category_name AS title";
	$field1 = "category_id";
	$table = "#__hikashop_category";
}
if($categories){
	$cat = implode(',',$categories);
}
$db = JFactory::getDbo();
$query = "SELECT {$field} FROM {$table} WHERE {$field1} IN({$cat})";
$db->setQuery($query);
$result = $db->loadObjectList();
if (empty($slides)) {
    print "There are no slide to show, Please make sure you have configured SlideShow correctly.";
    return;
}
?>
<style type="text/css">
<?php if (!$jmnewspro_show_pager): ?>        
        #jmnewspro-<?php print $module->id; ?> .bx-controls{
            display: none;
        }
<?php endif; ?>
<?php if($jmnewspro_pager_position == 'topleft'):?>
        #jmnewspro-<?php print $module->id; ?> .bx-controls{
            left: 0; position: absolute; top: -15px;
        }
<?php elseif($jmnewspro_pager_position == 'topright'):?>
        #jmnewspro-<?php print $module->id; ?> .bx-controls{
            right: 0; position: absolute; top: -15px;
        }
<?php elseif($jmnewspro_pager_position == 'bottomleft'):?>
        #jmnewspro-<?php print $module->id; ?> .bx-controls{
            left: 0; position: absolute; bottom: -15px;
        }
<?php elseif($jmnewspro_pager_position == 'bottomright'):?>
        #jmnewspro-<?php print $module->id; ?> .bx-controls{
            right: 0; position: absolute; bottom: -15px;
        }
<?php endif;?>
#jmnewspro-<?php print $module->id; ?> .slide-item-wrap{
	position: relative;
}        
</style>
<!-- START Responsive Carousel MODULE -->
<ul id="filters" class="clearfix">
	<li class="current"><a data-filter="*"><?php echo JText::_('All');?></a></li>
<?php if($result){
	foreach($result as $i=>$cat){?>
		<!--<li><a href="#" data-filter=".category< ?php echo $cat->id;?>"> < ?php echo $cat->title;?></a></li>-->
		<li><a data-filter=".category<?php echo $cat->id;?>"><?php echo $cat->title;?></a></li>
<?php } }?>
</ul>
<div class="jmnewspro <?php echo $tpl_name; ?> portfolio cols<?php echo $jmnewspro_maxslide; ?> <?php echo $moduleclass_sfx; ?>  <?php echo ($params->get('jmnewspro_layout', 'default'))?' '.$params->get('jmnewspro_layout', 'default'):''?>" id="jmnewspro-<?php print $module->id; ?>">
		<div class="slider">
        <?php foreach ($slides as $slide): ?>
            <div class="slide-item category<?php echo $slide->category;?>">
                <div class="slide-item-wrap">
                    <div class="slide-item-wrap-item">
                        <?php if($jmnewspro_show_image):?>
                            <div class="slide-item-image clearfix">
                                <?php if($jmnewspro_image_link):?>
                                <a href="<?php print $slide->link;?>"><img src="<?php echo $slide->getMainImage(); ?>"></a>
                                <?php else:?>
                                <img src="<?php echo $slide->getMainImage(); ?>">
                                <?php endif;?>
                            </div>
                        <?php endif; ?>
                        <?php if ($jmnewspro_show_title || $jmnewspro_show_desc || $jmnewspro_show_readmore): ?>
                            <div class="slide-item-desc-warp<?php print ($jmnewspro_hover) ? ' jmnewsprohover' : ''; ?>">
                                <div class="slide-inner">
									<div class="padding">
										<article class="padding2">
											<?php if ($jmnewspro_show_readmore || $jmnewspro_show_popup): ?>
											<div class="detailButtonWrap">
												<?php if ($jmnewspro_show_readmore ): ?>
													<a class="slide-item-readmore hasTip" data-original-title="View details" href="<?php print $slide->link ?>"><i class="fa fa-link"></i></a>
												<?php endif; ?>
												<?php if ($jmnewspro_show_popup): ?>
													<a class="slide-item-zoom colorbox hasTip" data-original-title="Open Image" href="<?php echo str_replace(JPATH_ROOT.'/',Juri::root(),$slide->image); ?>" title="Open images"><i class="fa fa-plus"></i></a>
												<?php endif; ?>
											</div>
											<?php endif; ?>
																			
										</article>
									</div>
								</div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if($jmnewspro_show_title || $jmnewspro_show_category) { ?>
                <div class="itemBottomInfo">
					<?php if($jmnewspro_show_title):?>
						<header class="slide-item-title entry-header"><h2 class="entry-title"><?php print $slide->title; ?></h2></header>
					<?php endif;?>
					<?php if($jmnewspro_show_category =='1'):?>
						<h2 class="category"><?php print $slide->category_name;?></h2>
					<?php endif;?>
					<?php if($jmnewspro_show_desc):?>
						<div class="slide-item-desc"><?php print $slide->description; ?></div>
					<?php endif;?>	
				</div>
				<?php } ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- END Responsive Carousel MODULE -->
<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#jmnewspro-<?php print $module->id;?> .slider').JMGrid({
			filter:'#filters > li a',
			cols: <?php echo $jmnewspro_maxslide; ?>,
			item: '.slide-item',
			itemWidth: <?php echo $jmnewspro_item_width;?>,
			itemHeight: <?php echo $jmnewspro_item_height;?>,
			hiddenClass: 'jmhidden',
			margin:<?php echo $jmnewspro_slidemargin;?>,
			marginBottom:(<?php echo (int)$jmnewspro_slidemargin;?>+50),
			OnFilter: function(){
				setTimeout(function(){
					$('#jmnewspro-<?php print $module->id;?> .padding').each(function(){
						$(this).width($(this).parents('.slide-item').width()).height($(this).parents('.slide-item').height());
					});
				},1000);
			}
		});
		$('#filters a').click(function(){
			$('#filters a').not(this).parent().removeClass('current');
			$(this).parent().addClass('current');
		})
		var obj = '#jmnewspro-<?php print $module->id; ?>';
		$(".colorbox").colorbox({rel:'.colorbox',maxWidth:'100%'});
		var nodes  = document.querySelectorAll('.portfolio .slide-item-wrap'),
		_nodes = [].slice.call(nodes, 0);
		var getDirection = function (ev, obj) {
			var w = $(obj).width(),
				h = $(obj).height(),
				x = (ev.pageX - $(obj).offset().left - (w / 2)) * (w > h ? (h / w) : 1),
				y = (ev.pageY - $(obj).offset().top - (h / 2)) * (h > w ? (w / h) : 1),
				d = Math.round( Math.atan2(y, x) / 1.57079633 + 5 ) % 4;
			return d;
		};

		var addClass = function ( ev, obj, state ) {
			var direction = getDirection( ev, obj ),
				class_suffix = "";

			obj.className = "";

			switch ( direction ) {
				case 0 : class_suffix = '-top';    break;
				case 1 : class_suffix = '-right';  break;
				case 2 : class_suffix = '-bottom'; break;
				case 3 : class_suffix = '-left';   break;
			}

			obj.classList.add( state + class_suffix );
		};

		// bind events
		$(_nodes).each(function(){
			$(this).hover(function(ev){
				addClass( ev, this, 'in' );
			},function(ev){
				addClass( ev, this, 'out' );
			})
		})
	});
</script>
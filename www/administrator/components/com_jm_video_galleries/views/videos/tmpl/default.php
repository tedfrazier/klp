<?php
/**
 * @package     com_jm_video_galleries
 * @version     1.0.0
 * Author - JoomlaMan http://www.joomlaman.com
 * Copyright (C) 2012 - 2013 JoomlaMan.com. All Rights Reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 * Websites: http://www.JoomlaMan.com
 * Support: support@joomlaman.com
*/
// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.tooltip');
JHTML::_('script','system/multiselect.js',false,true);
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_jm_video_galleries/assets/css/jm_video_galleries.css');
$user	= JFactory::getUser();
$userId	= $user->get('id');
$listOrder	= $this->state->get('list.ordering');
$listDirn	= $this->state->get('list.direction');
$canOrder	= $user->authorise('core.edit.state', 'com_jm_video_galleries');
$saveOrder	= $listOrder == 'a.ordering';
?>
<form action="<?php echo JRoute::_('index.php?option=com_jm_video_galleries&view=videos'); ?>" method="post" name="adminForm" id="adminForm">
	<fieldset id="filter-bar" class="btn-toolbar">
		<div class="filter-search fltlft pull-left">
			<label class="filter-search-lbl" for="filter_search" style="display:none"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('Search'); ?>" />
			<button type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
		</div>
		<div class="filter-select fltrt pull-right">
			<?php //Filter for the field video_type
			$selected_video_type = JRequest::getVar('filter_video_type');
			jimport('joomla.form.form');
			JForm::addFormPath(JPATH_COMPONENT . '/models/forms');
			$form = JForm::getInstance('com_jm_video_galleries.video', 'video');
			echo $form->getInput('filter_video_type', null, $selected_video_type);
			?>
		</div>
		<div class='filter-select fltrt pull-right'>
			<select name="filter_published" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_PUBLISHED');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), "value", "text", $this->state->get('filter.state'), true);?>
			</select>
		</div>
		<div class='filter-select fltrt pull-right'>
			<?php //Filter for the field cat_ids
			$selected_cat_ids = JRequest::getVar('filter_cat_ids');
			jimport('joomla.form.form');
			JForm::addFormPath(JPATH_COMPONENT . '/models/forms');
			$form = JForm::getInstance('com_jm_video_galleries.video', 'video');
			echo $form->getInput('filter_cat_ids', null, $selected_cat_ids);
			?>
		</div>
	</fieldset>
	<div class="clr"> </div>
	<table class="adminlist table table-striped">
		<thead>
			<tr>
				<th width="1%">
					<input type="checkbox" name="checkall-toggle" value="" onclick="Joomla.checkAll(this)" />
				</th>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_JM_VIDEO_GALLERIES_VIDEOS_TITLE', 'a.title', $listDirn, $listOrder); ?>
				</th>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_JM_VIDEO_GALLERIES_VIDEOS_VIDEO_TYPE', 'a.video_type', $listDirn, $listOrder); ?>
				</th>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_JM_VIDEO_GALLERIES_VIDEOS_IMAGE', 'a.image', $listDirn, $listOrder); ?>
				</th>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_JM_VIDEO_GALLERIES_VIDEOS_CAT_IDS', 'a.cat_ids', $listDirn, $listOrder); ?>
				</th>
				<th class='left'>
				<?php echo JHtml::_('grid.sort',  'COM_JM_VIDEO_GALLERIES_VIDEOS_CREATED_BY', 'a.created_by', $listDirn, $listOrder); ?>
				</th>
                <?php if (isset($this->items[0]->state)) { ?>
				<th width="5%">
					<?php echo JHtml::_('grid.sort',  'JPUBLISHED', 'a.state', $listDirn, $listOrder); ?>
				</th>
                <?php } ?>
                <?php if (isset($this->items[0]->ordering)) { ?>
				<th width="10%">
					<?php echo JHtml::_('grid.sort',  'JGRID_HEADING_ORDERING', 'a.ordering', $listDirn, $listOrder); ?>
					<?php if ($canOrder && $saveOrder) :?>
						<?php echo JHtml::_('grid.order',  $this->items, 'filesave.png', 'videos.saveorder'); ?>
					<?php endif; ?>
				</th>
                <?php } ?>
                <?php if (isset($this->items[0]->id)) { ?>
                <th width="1%" class="nowrap">
                    <?php echo JHtml::_('grid.sort',  'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                </th>
                <?php } ?>
			</tr>
		</thead>
		<tfoot>
			<?php 
                if(isset($this->items[0])){
                    $colspan = count(get_object_vars($this->items[0]));
                }
                else{
                    $colspan = 10;
                }
            ?>
			<tr>
				<td colspan="<?php echo $colspan ?>">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php foreach ($this->items as $i => $item) :
			$ordering	= ($listOrder == 'a.ordering');
			$canCreate	= $user->authorise('core.create',		'com_jm_video_galleries');
			$canEdit	= $user->authorise('core.edit',			'com_jm_video_galleries');
			$canCheckin	= $user->authorise('core.manage',		'com_jm_video_galleries');
			$canChange	= $user->authorise('core.edit.state',	'com_jm_video_galleries');
			?>
			<tr class="row<?php echo $i % 2; ?>">
				<td class="center">
					<?php echo JHtml::_('grid.id', $i, $item->id); ?>
				</td>
				<td>
				<?php if (isset($item->checked_out) && $item->checked_out) : ?>
					<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'videos.', $canCheckin); ?>
				<?php endif; ?>
				<?php if ($canEdit) : ?>
					<a href="<?php echo JRoute::_('index.php?option=com_jm_video_galleries&task=video.edit&id='.(int) $item->id); ?>">
					<?php echo $this->escape($item->title); ?></a>
				<?php else : ?>
					<?php echo $this->escape($item->title); ?>
				<?php endif; ?>
				</td>
				<td>
					<?php echo $item->video_type; ?>
				</td>
				<td>
					<?php if($item->image==''){
						$img = 'components/com_jm_video_galleries/assets/images/no-image.png';
					}else{
						$img = JUri::root(TRUE).'/'.$item->image;
					}?>
					<img src="<?php echo $img; ?>" style="width:60px;"/>
				</td>
				<td>
					<?php
					//print_r($item->cat_ids);
					$data = array();
					foreach(explode(',',$item->cat_ids) as $value):
						$db = JFactory::getDbo();
						$query	= $db->getQuery(true);
						$query = "SELECT c.title 
									FROM `#__jmvg_videos` AS a 
									JOIN #__jmvg_categories AS c
									WHERE c.id = {$value}";
						/* $query
							->select('title')
							->from('`#__jmvg_videos`')
							->where('id = ' .$value); */
						$db->setQuery($query);
						$results = $db->loadObjectList();
						//print_r($results);die;
						if(count($results)){
							$data[] = $results[0]->title;
						}
					endforeach;
					echo implode(',',$data); ?>
				</td>
				<td>
					<?php echo $item->created_by; ?>
				</td>
                <?php if (isset($this->items[0]->state)) { ?>
				    <td class="center">
					    <?php echo JHtml::_('jgrid.published', $item->state, $i, 'videos.', $canChange, 'cb'); ?>
				    </td>
                <?php } ?>
                <?php if (isset($this->items[0]->ordering)) { ?>
				    <td class="order">
					    <?php if ($canChange) : ?>
						    <?php if ($saveOrder) :?>
							    <?php if ($listDirn == 'asc') : ?>
								    <span><?php echo $this->pagination->orderUpIcon($i, true, 'videos.orderup', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
								    <span><?php echo $this->pagination->orderDownIcon($i, $this->pagination->total, true, 'videos.orderdown', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
							    <?php elseif ($listDirn == 'desc') : ?>
								    <span><?php echo $this->pagination->orderUpIcon($i, true, 'videos.orderdown', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
								    <span><?php echo $this->pagination->orderDownIcon($i, $this->pagination->total, true, 'videos.orderup', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
							    <?php endif; ?>
						    <?php endif; ?>
						    <?php $disabled = $saveOrder ?  '' : 'disabled="disabled"'; ?>
						    <input type="text" name="order[]" size="5" value="<?php echo $item->ordering;?>" <?php echo $disabled ?> class="text-area-order" />
					    <?php else : ?>
						    <?php echo $item->ordering; ?>
					    <?php endif; ?>
				    </td>
                <?php } ?>
                <?php if (isset($this->items[0]->id)) { ?>
				<td class="center">
					<?php echo (int) $item->id; ?>
				</td>
                <?php } ?>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<div id="Copyright-JoomlaMan">
		<p>Copyright &copy;2013 <a href="http://www.joomlaman.com/" target="blank">Joomla Man</a>. All Rights Reserved.<p>
		<p>JM Video Gallery Lite is Free Software and is distributed under the terms of the GNU General Public License, version 1.0 or - at your option - any later version.</p>
		<p>If you use JM Video Gallery Lite Core, please post a rating and a review at the Joomla! Extensions Directory.</p>
	</div>
	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>

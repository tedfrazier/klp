<?php
/*----------------------------------------------------------------------
# Package - JM Template
# ----------------------------------------------------------------------
# Author - JoomlaMan http://www.joomlaman.com
# Copyright Copyright under commercial licence (C) 2012 - 2013 JoomlaMan
#license http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3
-----------------------------------------------------------------------*/

/**
 * Helix Framework Credit
 * Template Name - Shaper Helix
 * Template Version 1.0.0
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 20010 - 2013 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die;
require_once(dirname(__FILE__).'/lib/lib.php');

$this->helix = Helix::getInstance();

if (!isset($this->error))
{
    $this->error = JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
    $this->debug = false;
}
//get language and direction
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;

$this->helix->getDocument()->setTitle($this->error->getCode() . ' - '.$this->title);


$this->helix->Header()
    ->setLessVariables(array(
        'preset'=>$this->helix->Preset(),
        'main_color'=> $this->helix->PresetParam('_main'),
        'header_color'=> $this->helix->PresetParam('_header'),
        'bg_color'=> $this->helix->PresetParam('_bg'),
        'text_color'=> $this->helix->PresetParam('_text'),
        'link_color'=> $this->helix->PresetParam('_link'),
        'bottom_color'=> $this->helix->PresetParam('_bottom'),
        'footer_color'=> $this->helix->PresetParam('_footer')
    ))
    ->addLess('master', 'template')
    ->addLess( 'presets',  'presets/'.$this->helix->Preset() );

$this->helix->header()->addLess('error', 'error');

require_once(JPATH_LIBRARIES.'/joomla/document/html/renderer/head.php');
$header_renderer = new JDocumentRendererHead($doc);
$header_contents = $header_renderer->render(null);
	
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"  lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"  lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"  lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?php echo $this->language; ?>"> <!--<![endif]-->
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <?php echo $header_contents; ?>
</head>
<body<?php echo $this->helix->bodyClass('bg clearfix error_bg'.Exp::addBodyClass()); ?>>
    <div id="frame_error">
        <div id="errorDescription">
            <div id="spman">
                <img alt="" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/spman.png" />
            </div>
            <div id="inforight">
                <div id="ifinner">
                    <h1 class="page-error"><?php echo $this->error->getCode(); ?></h1>
                    <h2 class="page-error jm-error jm-bg"><?php echo $this->error->getMessage(); ?></h2>
                    <div id="errorboxbody">
                        <span class="page-error jm-color jm-error jm-font-size"><?php echo JText::_('JM_LANG_ERROR_OOOPS'); ?></span>
                        <span class="page-error jm-error jm-font-size"><?php echo JText::_('JM_LANG_ERROR_DESC'); ?></span>
                        <span class="jm-font-size"><?php echo JText::_('JM_PLEASE'); ?></span><a class="gohome jm-font-size" href="<?php echo $this->baseurl; ?>/index.php" title="<?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?>"><?php echo JText::_('JM_LAYOUT_HOME_PAGE'); ?></a><span class="jm-font-size"><?php echo JText::_('JM_FOLLOWWING_PAGES'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
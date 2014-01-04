<?php
/**
 * @package Helix Framework
 * Template Name - Shaper Helix
 * Template Version 1.0.3
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2013 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');   
require_once(dirname(__FILE__).'/lib/lib.php');
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"  lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"  lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"  lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?php echo $this->language; ?>"> <!--<![endif]-->
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <jdoc:include type="head" />
        <?php
            $this->helix->Header()
			->addCSS('animate.css')
			->addJS('helix.core.js,easing.js,init.js,tools.js, retina.js,smoothscroll.js')
            ->setLessVariables(array(
                    'preset'=>$this->helix->Preset(),
                    'main_color'=> $this->helix->PresetParam('_color'),
                    'header_bgcolor'=> $this->helix->PresetParam('_headerbg'),
                    'header_linkcolor'=> $this->helix->PresetParam('_headerlink'),
                    'bg_color'=> $this->helix->PresetParam('_bg'),
                    'text_color'=> $this->helix->PresetParam('_text'),
                    'link_color'=> $this->helix->PresetParam('_link'),
					'bottom_color'=> $this->helix->PresetParam('_bottom'),
					'footer_color'=> $this->helix->PresetParam('_footer')
                ))
            ->addLess('master', 'template')
            ->addLess( 'presets',  'presets/'.$this->helix->Preset() );
        ?>
    </head>
    <body <?php echo $this->helix->bodyClass('bg hfeed clearfix '.Exp::addBodyClass()); ?> data-header-resize="<?php echo $this->helix->Param('headerResize'); ?>"  data-small-header="<?php echo $this->helix->Param('smallHeader'); ?>" data-big-header="<?php echo $this->helix->Param('bigHeader'); ?>">
		<div class="body-innerwrapper">
        <!--[if lt IE 8]>
        <div class="chromeframe alert alert-danger" style="text-align:center">You are using an <strong>outdated</strong> browser. Please <a target="_blank" href="http://browsehappy.com/">upgrade your browser</a> or <a target="_blank" href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</div>
        <![endif]-->
        <?php
            $this->helix->layout();
            $this->helix->Footer();
        ?>
        <jdoc:include type="modules" name="debug" />
		</div>
    </body>
</html>
<?php
/*----------------------------------------------------------------------
# Package - JM Template
# ----------------------------------------------------------------------
# Author - JoomlaMan http://www.joomlaman.com
# Copyright Copyright under commercial licence (C) 2012 - 2013 JoomlaMan
# License http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3
-----------------------------------------------------------------------*/

/**
 * Helix Framework Credit
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2001 - 2013 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined ('_JEXEC') or die('resticted aceess');

class HelixFeatureMenu {

	private $helix;

	public function __construct($helix){
		$this->helix = $helix;
	}

	public function onHeader()
	{
		if ($this->helix->megaMenuType()=='drop') {
			$this->helix->addInlineCSS('#sublevel ul.level-1 {display:none}');
		}
		$this->helix->addJS('menu.js');
		$this->helix->addCSS('mobile-menu.css');
	}

	public function onFooter()
	{
		ob_start();
		?>	

		
		<?php
		return ob_get_clean();
	}


	public function Position()
	{
		return 'menu';
	}


	public function onPosition()
	{        

		$menu = $this->helix->loadMegaMenu();

		if ($menu) {

			ob_start();

				?>

					<div id="sp-main-menu" class="visible-desktop clearfix">
						<?php echo $menu->showMenu(); ?>        
					</div>

					<?php if( $this->helix->Param('menudrill') == 'drillmodel'){ ?>
                    <a class="hidden-desktop btn sp-main-menu-toggler" href="#" data-toggle="collapse" data-target=".nav-collapse">
                        <i class="fa fa-align-justify"></i>
                    </a>

                    <div class="hidden-desktop sp-mobile-menu nav-collapse collapse">
                        <?php
                            $mobilemenu = $this->helix->loadMobileMenu();
                            echo $mobilemenu->showMenu();
                        ?>
                    </div>
					<?php } ?>
					
					<?php if( $this->helix->Param('menudrill') == 'drillclassic'){ ?>
                        <div class="hidden-desktop sp-main-menu-toggler">
							<div class="btn" id="sp-mobile-menu">
								<i class="fa fa-align-justify"></i>
							</div>
                        </div>
                    <?php } ?>

				<?php

            if (($this->helix->megaMenuType()=='split') && $menu->hasSub() || $this->helix->megaMenuType()=='drop') {
                if($this->helix->megaMenuType()=='drop'){
                    $newclass = 'dropline empty ';
                } else{
                    $newclass = 'split ';
                }

                echo '<div id="sublevel" class="' . $newclass . 'visible-desktop clearfix"><div class="container">';
                $menu->showMenu(1);
                echo '</div></div>';
            }

			if (($this->helix->megaMenuType()=='split' && $menu->hasSub()) || $this->helix->megaMenuType()=='drop') {
				$sublevel=1;
			} else {
				$sublevel=0;
			}

			$drop = $this->helix->megaMenuType() == 'drop'?'drop':'';
            $this->helix->addInlineJS("jQuery(function($){
                mainmenu();

                function mainmenu() {
                    $('.sp-menu').spmenu{$drop}({
                        startLevel: 0,
                        direction: '" . $this->helix->direction() . "',
                        initOffset: {
                            x: ".$this->helix->Param('init_x',0).",
                            y: ".$this->helix->Param('init_y',0)."
                        },
                        subOffset: {
                            x: ".$this->helix->Param('sub_x',0).",
                            y: ".$this->helix->Param('sub_y',0)."
                        },
                        center: ".$this->helix->Param('submenu_position',0).",
                            mainWidthFrom: 'body',
                            type: '".$this->helix->megaMenuType()."'
                    });
                }
				
				/* Mobile Menu */
                $('#sp-main-menu > ul').mobileMenu({
                    defaultText:'".JText::_('NAVIGATE')."',
                    appendTo: '#sp-mobile-menu'
                });

                });");

			return ob_get_clean();
		}
	}    
}
<!--layout:Default,order:1-->
<?php
/* * --------------------------------------------------------------------
  # Package - JoomlaMan JM Socials
  # Version 1.0.0
  # --------------------------------------------------------------------
  # Author - JoomlaMan http://www.joomlaman.com
  # Copyright © 2012 - 2013 JoomlaMan.com. All Rights Reserved.
  # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
  # Websites: http://www.JoomlaMan.com
  ---------------------------------------------------------------------* */
// no direct access
defined('_JEXEC') || die('Restricted access');
$jmsocials_link_target = $params->get('jmsocials_link_target','_blank');
?> 
<div class="jmSocialIcon20 jmsocials_wrap <?php echo $moduleclass_sfx; ?>" id="jmsocials_wrap<?php echo $module_id; ?>">
  <ul class="jmsocials_items">
    <?php
    if ($items) {
      foreach ($items as $i => $item) {
        ?>
        <li class="jmsocials_item <?php echo  'jm' . $item->itemType; ?>" style="margin-<?php echo (Helix::direction()=='rtl')?'left':'right';?>:2px;">
          <a class="jmsocials_link hasTip" target="<?php echo $jmsocials_link_target; ?>" href="<?php echo $item->itemLink; ?>" title="<?php echo $item->itemTitle; ?>" data-original-title="<?php echo $item->itemTitle; ?>">
            <i class="<?php echo $item->itemClass ; ?>"></i>
          </a>
        </li>
      <?php
      }
    }
    ?>
  </ul>
</div>
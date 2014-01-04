<?php

/**
 * @package		Joomla.Site
 * @subpackage	com_contact
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

/* marker_class: Class based on the selection of text, none, or icons
 * jfa fa-text, jfa fa-none, jfa fa-icon
 */
?>
<?php if (($this->params->get('address_check') > 0) &&  ($this->contact->address || $this->contact->suburb  || $this->contact->state || $this->contact->country || $this->contact->postcode)) : ?>
	<div class="contact-address">
	<?php if ($this->params->get('address_check') > 0) : ?>
		<span class="<?php echo $this->params->get('marker_class'); ?> <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>" >
			<?php echo $this->params->get('marker_address'); ?>
		</span>
		<address style="padding-<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>:80px;">
	<?php endif; ?>
	<?php if ($this->contact->address && $this->params->get('show_street_address')) : ?>
		<span class="contact-street">
			<?php echo nl2br($this->contact->address); ?>
		</span>
	<?php endif; ?>
	<?php if ($this->contact->suburb && $this->params->get('show_suburb')) : ?>
		<span class="contact-suburb">
			<?php echo $this->contact->suburb; ?>
		</span>
	<?php endif; ?>
	<?php if ($this->contact->state && $this->params->get('show_state')) : ?>
		<span class="contact-state">
			<?php echo $this->contact->state; ?>
		</span>
	<?php endif; ?>
	<?php if ($this->contact->postcode && $this->params->get('show_postcode')) : ?>
		<span class="contact-postcode">
			<?php echo $this->contact->postcode; ?>
		</span>
	<?php endif; ?>
	<?php if ($this->contact->country && $this->params->get('show_country')) : ?>
		<span class="contact-country">
			<?php echo $this->contact->country; ?>
		</span>
	<?php endif; ?>
<?php endif; ?>

<?php if ($this->params->get('address_check') > 0) : ?>
	</address>
	</div>
<?php endif; ?>

<?php if($this->params->get('show_email') || $this->params->get('show_telephone')||$this->params->get('show_fax')||$this->params->get('show_mobile')|| $this->params->get('show_webpage') ) : ?>
	<div class="contact-contactinfo">
<?php endif; ?>

<?php if ($this->contact->mobile && $this->params->get('show_mobile')) :?>
	<div class="clearfix">
		<span class="<?php echo $this->params->get('marker_class'); ?> <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>">
			<?php echo $this->params->get('marker_mobile'); ?>
		</span>
		<div class="contact-mobile" style="padding-<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>:80px;">
			<?php echo nl2br($this->contact->mobile); ?>
		</div>
	</div>
<?php endif; ?>
<?php if ($this->contact->telephone && $this->params->get('show_telephone')) : ?>
	<div class="clearfix">
		<span class="<?php echo $this->params->get('marker_class'); ?> <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>" >
			<?php echo $this->params->get('marker_telephone'); ?>
		</span>
		<div class="contact-telephone" style="padding-<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>:80px;">
			<?php echo nl2br($this->contact->telephone); ?>
		</div>
	</div>
<?php endif; ?>
<?php if ($this->contact->fax && $this->params->get('show_fax')) : ?>
	<div class="clearfix">
		<span class="<?php echo $this->params->get('marker_class'); ?> <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>" >
			<?php echo $this->params->get('marker_fax'); ?>
		</span>
		<div class="contact-fax" style="padding-<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>:80px;">
		<?php echo nl2br($this->contact->fax); ?>
		</div>
	</div>
<?php endif; ?>

<?php if ($this->contact->email_to && $this->params->get('show_email')) : ?>
	<div class="clearfix">
		<span class="<?php echo $this->params->get('marker_class'); ?> <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>" >
			<?php echo $this->params->get('marker_email'); ?>
		</span>
		<div class="contact-emailto" style="padding-<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>:80px;">
			<?php echo $this->contact->email_to; ?>
		</div>
	</div>
<?php endif; ?>
<?php if ($this->contact->webpage && $this->params->get('show_webpage')) : ?>
	<div class="clearfix">
		<span class="<?php echo $this->params->get('marker_class'); ?> <?php echo (Helix::direction()=='rtl')?'right':'left'; ?>" >
		</span>
		<div class="contact-webpage" style="padding-<?php echo (Helix::direction()=='rtl')?'right':'left'; ?>:80px;">
			<a href="<?php echo $this->contact->webpage; ?>" target="_blank">
			<?php echo $this->contact->webpage; ?></a>
		</div>
	</div>
<?php endif; ?>
<?php if($this->params->get('show_email') || $this->params->get('show_telephone')||$this->params->get('show_fax')||$this->params->get('show_mobile')|| $this->params->get('show_webpage') ) : ?>
	</div>
<?php endif; ?>

<?php
/*----------------------------------------------------------------------
# Package - JM Template
# ----------------------------------------------------------------------
# Author - JoomlaMan http://www.joomlaman.com
# Copyright Copyright under commercial licence (C) 2012 - 2013 JoomlaMan
# License http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3
-----------------------------------------------------------------------*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

class HelixFeatureCookieLaw {

	private $helix;

	public function __construct($helix){
		$this->helix = $helix;
	}

	public function onHeader()
	{

	}

	public function onFooter()
	{

	}


	public function Position()
	{

		return $this->helix->Param('cookie_consent');
	}


	public function onPosition()
	{        
		$document=JFactory::getDocument();
		if($this->helix->Param('cookie_consent', '0') == '1') : ?>
		 	<!-- Begin Cookie Consent plugin by Silktide - http://silktide.com/cookieconsent -->
		      <!-- cookie conset latest version or not -->
		      <?php if($this->helix->Param('cookie_latest_version', '0') == '0') : ?>
			   <?php if($this->helix->Param('cookiecss', '1') == '1'){
			   	$document->addStyleSheet('https://s3-eu-west-1.amazonaws.com/assets.cookieconsent.silktide.com/1.0.7/style.min.css');
			   	
			   }
			   $document->addScript('https://s3-eu-west-1.amazonaws.com/assets.cookieconsent.silktide.com/1.0.7/plugin.min.js');
			   ?>
		      <?php else : ?>
			   <?php if($this->helix->Param('cookiecss', '1') == '1'){
			   	$document->addStyleSheet('https://s3-eu-west-1.amazonaws.com/assets.cookieconsent.silktide.com/current/style.min.css');
	   		}
			   $document->addScript('https://s3-eu-west-1.amazonaws.com/assets.cookieconsent.silktide.com/current/plugin.min.js');
		      endif;
		      if($this->helix->Param('refreshOnConsent', '0') == '1'){
		      		$refresh='true';
		      }
		      else{
		      		$refresh='false';
		      }
		      if($this->helix->Param('cookie_use_ssl', '0') == '1'){
		      		$ssl='true';
		      }
		      else{
		      		$ssl='false';
		      }
		    $html='
		      // <![CDATA[
		      cc.initialise({
			   cookies: {
				social: {},
				analytics: {}
			   },
			   settings: {
				bannerPosition: "'.$this->helix->Param('banner_position', 'bottom').'",
				consenttype: "'.$this->helix->Param('consenttype', 'helixlicit').'",
				onlyshowbanneronce: false,
				style: "'.$this->helix->Param('cookie_style', 'light').'",
				refreshOnConsent: '.$refresh.',
				useSSL: '.$ssl.',
				tagPosition: "'.$this->helix->Param('banner_tag_placement', 'bottom-right').'"
			   },
			   strings: {
				socialDefaultTitle: "Social media",
				socialDefaultDescription: "Facebook, Twitter and other social websites need to know who you are to work properly.",
				analyticsDefaultTitle: "Analytics",
				analyticsDefaultDescription: "We anonymously measure your use of this website to improve your helixerience.",
				advertisingDefaultTitle: "Advertising",
				advertisingDefaultDescription: "Adverts will be chosen for you automatically based on your past behaviour and interests.",
				defaultTitle: "Default cookie title",
				defaultDescription: "Default cookie description.",
				learnMore: "Learn more",
				closeWindow: "Close window",
				notificationTitle: "Your experience on this site, will be improved by allowing cookies",
				notificationTitleImplicit: "We use cookies to ensure you, get the best helixerience on our website",
				customCookie: "This website uses a custom type of cookie which needs specific approval",
				seeDetails: "see details",
				seeDetailsImplicit: "change your settings",
				hideDetails: "hide details",
				allowCookies: "Allow cookies",
				allowCookiesImplicit: "Close",
				allowForAllSites: "Allow for all sites",
				savePreference: "Save preference",
				saveForAllSites: "Save for all sites",
				privacySettings: "Privacy settings",
				privacySettingsDialogTitleA: "Privacy settings",
				privacySettingsDialogTitleB: "for this website",
				privacySettingsDialogSubtitle: "Some features of this website need your consent to remembe,r who you are.",
				changeForAllSitesLink: "Change settings for all websites",
				preferenceUseGlobal: "Use global setting",
				preferenceConsent: "I consent",
				preferenceDecline: "I decline",
				notUsingCookies: "This website does not use any, cookies.",
				allSitesSettingsDialogTitleA: "Privacy settings",
				allSitesSettingsDialogTitleB: "for all websites",
				allSitesSettingsDialogSubtitle: "You may consent to these cook,ies for all websites that use ,this plugin.",
				backToSiteSettings: "Back to website settings",
				preferenceAsk: "Ask me each time",
				preferenceAlways: "Always allow",
				preferenceNever: "Never allow"
		 }
		      });
		      // ]]>';
		 $document->addScriptDeclaration($html);
		 endif;
	}    
}?>

<?php

/* * --------------------------------------------------------------------
  # Package - JoomlaMan Module
  # Version 1.0
  # --------------------------------------------------------------------
  # Author - JoomlaMan http://www.joomlaman.com
  # Copyright (coffee) 2012 - 2013 JoomlaMan.com. All Rights Reserved.
  # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
  # Websites: http://www.JoomlaMan.com
  ---------------------------------------------------------------------* */
defined('_JEXEC') or die('Restricted access');
require_once 'sources/date_difference.php';
class modJmTwitterrollHelper {
	static function getTweets($params){
		$oauth_access_token = $params->get('oauth_access_token');
		$oauth_access_token_secret = $params->get('oauth_access_token_secret');
		$consumer_key = $params->get('consumer_key');
		$consumer_secret = $params->get('consumer_secret');
		$base_url = 'http://api.twitter.com/1.1/statuses/user_timeline.json';
		$url_arguments = array(
			'screen_name' => $params->get('searchTerm'),
			'count' => $params->get('count',5)
		);
		$config = array(
			'oauth_access_token' => $oauth_access_token,
			'oauth_access_token_secret' => $oauth_access_token_secret,
			'consumer_key' => $consumer_key,
			'consumer_secret' => $consumer_secret,
			'base_url' => 'http://api.twitter.com/1.1/'
		);
		$oauth = array(
			'oauth_consumer_key' => $config['consumer_key'],
			'oauth_nonce' => time(),
			'oauth_signature_method' => 'HMAC-SHA1',
			'oauth_token' => $config['oauth_access_token'],
			'oauth_timestamp' => time(),
			'oauth_version' => '1.0'
		);
		
		$base_info = modJmTwitterrollHelper::__buildBaseString($base_url, 'GET', array_merge($oauth, $url_arguments));
		$composite_key = rawurlencode($config['consumer_secret']) . '&' . rawurlencode($config['oauth_access_token_secret']);
		$oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
		$oauth['oauth_signature'] = $oauth_signature;
		$header = array(
			modJmTwitterrollHelper::__buildAuthorizationHeader($oauth),
			'Expect:'
		);
		$full_url = $base_url."?screen_name={$params->get('searchTerm')}&count={$params->get('count')}";
		$options = array(
			CURLOPT_HTTPHEADER => $header,
			CURLOPT_HEADER => false,
			CURLOPT_URL => $full_url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false
		);
		//print_r($options);die;
		$feed = curl_init();
		curl_setopt_array($feed, $options);
		$result = curl_exec($feed);
		$info = curl_getinfo($feed);
		curl_close($feed);
		return json_decode($result);
	}
	
	static function __buildAuthorizationHeader($oauth) {
		$r = 'Authorization: OAuth ';
		$values = array();
		foreach ($oauth as $key => $value)
			$values[] = "$key=\"" . rawurlencode($value) . "\"";
		$r .= implode(', ', $values);
		return $r;
	}
	
	static function __buildBaseString($baseURI, $method, $params) {
		$r = array();
		ksort($params);
		foreach ($params as $key => $value) {
			$r[] = "$key=" . rawurlencode($value);
		}
		return $method . "&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
	}

	static function prettyDate($time) {
		return Date_Difference::getStringResolved($time);
	}
	
	static function getTemplate() {
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__template_styles');
		$query->where('home=1');
		$query->where('client_id=0');
		$db->setQuery($query);
		return $db->loadObject()->template;
	}
}
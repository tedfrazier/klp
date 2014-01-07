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
define('_JEXEC', 1);
define('DS', DIRECTORY_SEPARATOR);
define('JPATH_BASE', dirname(__FILE__) . DS . ".." . DS . ".." . DS . "..");
require_once ( JPATH_BASE . DS . 'includes' . DS . 'defines.php' );
require_once ( JPATH_BASE . DS . 'includes' . DS . 'framework.php' );
$mainframe = JFactory::getApplication('site');
$mainframe->initialise();
jimport('joomla.application.module.helper');
$module = JModuleHelper::getModule('jmtwitterroll');
$params = json_decode($module->params);
$oauth_access_token = $params->oauth_access_token;
$oauth_access_token_secret = $params->oauth_access_token_secret;
$consumer_key = $params->consumer_key;
$consumer_secret = $params->consumer_secret;

$config = array(
    'oauth_access_token' => $oauth_access_token,
    'oauth_access_token_secret' => $oauth_access_token_secret,
    'consumer_key' => $consumer_key,
    'consumer_secret' => $consumer_secret,
    'base_url' => 'http://api.twitter.com/1.1/'
);
if (!isset($_GET['url'])) {
  die('No URL set');
}
$url = $_GET['url'];
$url_parts = parse_url($url);
$url_arguments = null;
parse_str($url_parts['query'], $url_arguments);
//$url_arguments['count']=5;
$full_url = $config['base_url'] . $url; // Url with the query on it.
$base_url = $config['base_url'] . $url_parts['path']; // Url without the query.

function buildBaseString($baseURI, $method, $params) {
  $r = array();
  ksort($params);
  foreach ($params as $key => $value) {
    $r[] = "$key=" . rawurlencode($value);
  }
  //$r[]='count='.$params->count;
  return $method . "&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
}

function buildAuthorizationHeader($oauth) {
  $r = 'Authorization: OAuth ';
  $values = array();
  foreach ($oauth as $key => $value)
    $values[] = "$key=\"" . rawurlencode($value) . "\"";
  $r .= implode(', ', $values);
  return $r;
}

// Set up the oauth Authorization array
$oauth = array(
    'oauth_consumer_key' => $config['consumer_key'],
    'oauth_nonce' => time(),
    'oauth_signature_method' => 'HMAC-SHA1',
    'oauth_token' => $config['oauth_access_token'],
    'oauth_timestamp' => time(),
    'oauth_version' => '1.0'
);
$base_info = buildBaseString($base_url, 'GET', array_merge($oauth, $url_arguments));
$composite_key = rawurlencode($config['consumer_secret']) . '&' . rawurlencode($config['oauth_access_token_secret']);
$oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
$oauth['oauth_signature'] = $oauth_signature;
// Make Requests
$header = array(
    buildAuthorizationHeader($oauth),
    'Expect:'
);
$options = array(
    CURLOPT_HTTPHEADER => $header,
    //CURLOPT_POSTFIELDS => $postfields,
    CURLOPT_HEADER => false,
    CURLOPT_URL => $full_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false
);
$feed = curl_init();

curl_setopt_array($feed, $options);
$result = curl_exec($feed);
$info = curl_getinfo($feed);
curl_close($feed);
header('Content-type: application/json');
print $result;
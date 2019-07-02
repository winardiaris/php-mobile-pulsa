<?php

namespace MobilePulsa;

// Check PHP version.
use Exception;

if (version_compare(PHP_VERSION, '5.2.1', '<')) {
  throw new Exception('PHP version >= 5.2.1 required');
}

// Check PHP Curl & json decode capabilities.
if (!function_exists('curl_init') || !function_exists('curl_exec')) {
  throw new Exception('MobilePulsa needs the CURL PHP extension.');
}

if (!function_exists('json_decode')) {
  throw new Exception('MobilePulsa needs the JSON PHP extension.');
}

// Configurations
require_once('MobilePulsa/Config.php');
require_once('MobilePulsa/ApiRequestor.php');
require_once('MobilePulsa/Base.php');

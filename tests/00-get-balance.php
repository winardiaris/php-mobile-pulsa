<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MobilePulsa\MPBase;
use MobilePulsa\MPConfig;

MPConfig::$isProduction = false;
MPConfig::$username = 'YOUR_USERNAME';
MPConfig::$apiKey = 'YOUR_API_KEY';

$balance = MPBase::getBalance();

var_dump($balance);

<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MobilePulsa\MPBase;
use MobilePulsa\MPConfig;

MPConfig::$isProduction = false;
MPConfig::$username = 'YOUR_USERNAME';
MPConfig::$apiKey = 'YOUR_API_KEY';

$prepaidPricelistAll = MPBase::getPrepaidPriceList();
$prepaidPricelistType = MPBase::getPrepaidPriceList('pln');
$prepaidPricelistTypeOperator = MPBase::getPrepaidPriceList('pulsa', 'telkomsel');
$prepaidPricelistStatus = MPBase::getPrepaidPriceList(null, null, 'non-active');

var_dump($prepaidPricelistStatus);

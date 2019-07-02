<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MobilePulsa\Base as MPBase;
use MobilePulsa\Config as MPConfig;

MPConfig::$isProduction = false;
MPConfig::$username = 'databisnis';
MPConfig::$apiKey = '6205a7971fb2ee67';

$prepaidPricelistAll = MPBase::getPrepaidPriceList();
$prepaidPricelistType = MPBase::getPrepaidPriceList('pln');
$prepaidPricelistTypeOperator = MPBase::getPrepaidPriceList('pulsa','telkomsel');

var_dump($prepaidPricelistType);

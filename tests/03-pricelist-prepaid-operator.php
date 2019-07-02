<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MobilePulsa\Base as MPBase;
use MobilePulsa\Config as MPConfig;

MPConfig::$isProduction = false;
MPConfig::$username = 'databisnis';
MPConfig::$apiKey = '6205a7971fb2ee67';

$prepaidPricelistType = MPBase::getPrepaidPriceListType();

var_dump($prepaidPricelistType);

<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MobilePulsa\MPBase;
use MobilePulsa\MPConfig;

MPConfig::$isProduction = false;
MPConfig::$username = 'YOUR_USERNAME';
MPConfig::$apiKey = 'YOUR_API_KEY';

$inquiryPlnPrepaid = MPBase::inquiryPlnPrepaid('12345678901');
$inquiryPlnPostpaid = MPBase::inquiryPlnPostpaid('530000000001');

var_dump($inquiryPlnPrepaid);
var_dump($inquiryPlnPostpaid);

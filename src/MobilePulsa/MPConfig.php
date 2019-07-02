<?php

namespace MobilePulsa;

/**
 * MobilePulsa Configuration
 */
class MPConfig
{

  /**
   * Your merchant's username key
   * @static
   */

  public static $username;

  /**
   * Your merchant's password key
   * @static
   */

  public static $apiKey;

  /**
   * true for production
   * false for sandbox mode
   * @static
   */

  public static $isProduction = false;

  /**
   * Default options for every request
   * @static
   */

  public static $curlOptions = array();

  public static $uriPrepaid;
  public static $uriPostpaid;

  const URI_PREPAID_SANDBOX = 'https://testprepaid.mobilepulsa.net/v1/legacy/index';
  const URI_POSTPAID_SANDBOX = 'https://testpostpaid.mobilepulsa.net/api/v1/bill/check';

  const URI_PREPAID = 'https://api.mobilepulsa.net/v1/legacy/index';
  const URI_POSTPAID = 'https://mobilepulsa.net/api/v1/bill/check';

  public static function getUriPrepaid()
  {
    return self::$isProduction ?
      self::URI_PREPAID : self::URI_PREPAID_SANDBOX;
  }

  public static function getUriPostpaid()
  {
    return self::$isProduction ?
      self::URI_POSTPAID : self::URI_POSTPAID_SANDBOX;
  }
}

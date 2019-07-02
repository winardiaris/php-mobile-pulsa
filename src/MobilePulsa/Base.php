<?php

namespace MobilePulsa;

class Base
{
    public function getBalance()
    {
        $commands = 'balance';
        $sign = md5(Config::$username . Config::$apiKey . 'bl');
        $url = Config::getUriPrepaid();
        $params = array(
            'commands' => $commands,
            'username' => Config::$username,
            'sign' => $sign
        );
        return ApiRequestor::post($url, $params);
    }

    /**
     * @param null $type
     * @param null $operator
     * @return mixed
     */
    public function getPrepaidPriceList($type = null, $operator = null)
    {
        $commands = 'pricelist';
        $sign = md5(Config::$username . Config::$apiKey . 'pl');
        $url = Config::getUriPrepaid();
        if ($type !== null) {
            if ($type !== null && $operator === null) {
                $url = $url . '/' . $type;
            } else if ($type !== null && $operator !== null) {
                $url = $url . '/' . $type . '/' . $operator;
            }
        }

        $params = array(
            'commands' => $commands,
            'username' => Config::$username,
            'sign' => $sign
        );

        return ApiRequestor::post($url, $params);
    }

    /**
     * @return array
     */
    public function getPrepaidPriceListType()
    {
        $type = array();
        $pricelist = self::getPrepaidPriceList();
        foreach ($pricelist->data as $data) {
            array_push($type, $data->pulsa_type);
        }
        return array_unique($type);
    }

    /**
     * @param null $type
     * @param string $status
     * @return array|mixed
     */
    public function getPostPaidPriceList($type = null, $status = 'all')
    {
        //status : all, active, non-active
        $commands = 'pricelist-pasca';
        $sign = md5(Config::$username . Config::$apiKey . 'pl');
        $url = Config::getUriPostpaid();

        $params = array(
            'commands' => $commands,
            'username' => Config::$username,
            'sign' => $sign,
            'status' => $status
        );

        $response = ApiRequestor::post($url, $params);

        if ($type) {
            $result = array();
            foreach ($response->data->pasca as $data) {
                if ($data->type === $type) {
                    array_push($result, $data);
                }
            }
        } else {
            $result = $response;
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getPostpaidPriceListType()
    {
        $type = array();
        $pricelist = self::getPostPaidPriceList();
        foreach ($pricelist->data->pasca as $data) {
            array_push($type, $data->type);
        }
        return array_unique($type);
    }
}
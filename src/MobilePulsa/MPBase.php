<?php

namespace MobilePulsa;

class MPBase
{
    public function getBalance()
    {
        $commands = 'balance';
        $sign = md5(MPConfig::$username . MPConfig::$apiKey . 'bl');
        $url = MPConfig::getUriPrepaid();
        $params = array(
            'commands' => $commands,
            'username' => MPConfig::$username,
            'sign' => $sign
        );
        $response = ApiRequestor::post($url, $params);
        return $response->data;
    }

    /**
     * @param string $type
     * @param string $operator
     * @param string $status
     * @return mixed
     */
    public function getPrepaidPriceList($type = null, $operator = null, $status = 'all')
    {
        //status : all, active, non-active
        $commands = 'pricelist';
        $sign = md5(MPConfig::$username . MPConfig::$apiKey . 'pl');
        $url = MPConfig::getUriPrepaid();
        if ($type !== null) {
            if ($type !== null && $operator === null) {
                $url = $url . '/' . $type;
            } else if ($type !== null && $operator !== null) {
                $url = $url . '/' . $type . '/' . $operator;
            }
        }

        $params = array(
            'commands' => $commands,
            'username' => MPConfig::$username,
            'sign' => $sign,
            'status' => $status
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
     * @return array
     */
    public function getPrepaidPriceListOperator()
    {
        $type = array();
        $pricelist = self::getPrepaidPriceList();
        foreach ($pricelist->data as $data) {
            array_push($type, $data->pulsa_op);
        }
        return array_unique($type);
    }

    /**
     * @param string $type
     * @param string $status
     * @return array|mixed
     */
    public function getPostpaidPriceList($type = null, $status = 'all')
    {
        //status : all, active, non-active
        $commands = 'pricelist-pasca';
        $sign = md5(MPConfig::$username . MPConfig::$apiKey . 'pl');
        $url = MPConfig::getUriPostpaid();

        $params = array(
            'commands' => $commands,
            'username' => MPConfig::$username,
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
        $pricelist = self::getPostpaidPriceList();
        foreach ($pricelist->data->pasca as $data) {
            array_push($type, $data->type);
        }
        return array_unique($type);
    }

    /**
     * @return array
     */
    public function inquiryPostpaid($code, $number)
    {
        $commands = 'inq-pasca';
        $reference_id = microtime();
        $sign = md5(MPConfig::$username . MPConfig::$apiKey . $reference_id);
        $url = MPConfig::getUriPostpaid();

        $params = array(
            'commands' => $commands,
            'username' => MPConfig::$username,
            'code' => $code,
            'hp' => $number,
            'ref_id' => $reference_id,
            'sign' => $sign
        );

        if ($code === 'BPJS') {
            $params['month'] = 1;
        }

        $response = ApiRequestor::post($url, $params);
        return $response->data;
    }

    /**
     * @return array
     */
    public function inquiryPlnPrepaid($number)
    {
        $commands = 'inquiry_pln';
        $sign = md5(MPConfig::$username . MPConfig::$apiKey . $number);
        $url = MPConfig::getUriPrepaid();

        $params = array(
            'commands' => $commands,
            'username' => MPConfig::$username,
            'hp' => $number,
            'sign' => $sign
        );

        $response = ApiRequestor::post($url, $params);
        return $response->data;
    }

    /**
     * @return array
     */
    public function inquiryPlnPostpaid($number)
    {
        return self::inquiryPostpaid('PLNPOSTPAID', $number);
    }

    /**
     * @return array
     */
    public function inquiryBpjs($number)
    {
        return self::inquiryPostpaid('BPJS', $number);
    }

    /**
     * @return array
     */
    public function inquiryPdam($code, $number)
    {
        return self::inquiryPostpaid($code, $number);
    }
}

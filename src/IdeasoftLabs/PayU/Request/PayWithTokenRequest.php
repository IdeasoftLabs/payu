<?php
namespace IdeasoftLabs\PayU\Request;

use GuzzleHttp\Client;
use IdeasoftLabs\PayU\Parameter\PayWithTokenParam;
use IdeasoftLabs\PayU\Parameter\Model\OrderItem;
use IdeasoftLabs\PayU\Response\PayWithTokenResponse;

/**
 * Class PayWithTokenRequest
 * @package IdeasoftLabs\PayU\Request
 */
class PayWithTokenRequest extends AbstractRequest
{
    /**
     * Prepare data
     * @return array
     */
    public function prepareData()
    {
        /** @var PayWithTokenParam $data */
        $data = $this->getData();

        $params['PAY_METHOD'] = 'CCVISAMC';
        $params['MERCHANT'] = $data->getMerchant();
        $params['ORDER_REF'] = $data->getOrderRef();
        $params['ORDER_DATE'] = $data->getOrderDate();
        $params['PRICES_CURRENCY'] = $data->getCurrency();
        $params['SELECTED_INSTALLMENTS_NUMBER'] = $data->getInstallment();
        $params['CLIENT_IP'] = $data->getIpAddress();
        $params['BILL_LNAME'] = $data->getBillingAddress()->getLastName();
        $params['BILL_FNAME'] = $data->getBillingAddress()->getFirstName();
        $params['BILL_EMAIL'] = $data->getBillingAddress()->getEmail();
        $params['BILL_PHONE'] = $data->getBillingAddress()->getPhone();
        $params['BILL_COUNTRYCODE'] = $data->getBillingAddress()->getCountryCode();
        $params['BILL_ZIPCODE'] = $data->getBillingAddress()->getZipCode();
        $params['BILL_ADDRESS'] = $data->getBillingAddress()->getAddress();
        $params['BILL_ADDRESS2'] = $data->getBillingAddress()->getAddress2();
        $params['BILL_CITY'] = $data->getBillingAddress()->getCity();
        $params['BILL_STATE'] = $data->getBillingAddress()->getState();
        $params['BILL_FAX'] = $data->getBillingAddress()->getFax();
        $params['DELIVERY_LNAME'] = $data->getDeliveryAddress()->getLastName();
        $params['DELIVERY_FNAME'] = $data->getDeliveryAddress()->getFirstName();
        $params['DELIVERY_EMAIL'] = $data->getDeliveryAddress()->getEmail();
        $params['DELIVERY_PHONE'] = $data->getDeliveryAddress()->getPhone();
        $params['DELIVERY_ADDRESS'] = $data->getDeliveryAddress()->getAddress();
        $params['DELIVERY_ADDRESS2'] = $data->getDeliveryAddress()->getAddress2();
        $params['DELIVERY_ZIPCODE'] = $data->getDeliveryAddress()->getZipCode();
        $params['DELIVERY_CITY'] = $data->getDeliveryAddress()->getCity();
        $params['DELIVERY_STATE'] = $data->getDeliveryAddress()->getState();
        $params['DELIVERY_COUNTRYCODE'] = $data->getDeliveryAddress()->getCountryCode();
        $params['CC_TOKEN'] = $data->getToken();
        $params['CC_NUMBER'] = "";
        $params['EXP_MONTH'] = "";
        $params['EXP_YEAR'] = "";
        $params['CC_CVV'] = "";
        $params['CC_OWNER'] = "";

        $i = 0;
        /** @var OrderItem $orderItem */
        foreach ($data->getOrderItems() as $orderItem) {
            $params['ORDER_PNAME[' . $i . ']'] = $orderItem->getName();
            $params['ORDER_PCODE[' . $i . ']'] = $orderItem->getCode();
            $params['ORDER_PINFO[' . $i . ']'] = $orderItem->getInfo();
            $params['ORDER_PRICE[' . $i . ']'] = $orderItem->getPrice();
            $params['ORDER_VER[' . $i . ']'] = $orderItem->getVat();
            $params['ORDER_QTY[' . $i . ']'] = $orderItem->getQuantity();
            $i++;
        }

        return $params;
    }

    /**
     * Send request
     * @return PayWithTokenResponse
     */
    public function send()
    {
        $postData = $this->prepareData();
        $postData["ORDER_HASH"] = $this->createHash($postData);

        // send
        $client = new Client();
        $response = $client->request('POST', $this->getData()->getPostUrl(), ['form_params' => $postData]);
        return new PayWithTokenResponse(@simplexml_load_string($response->getBody()->getContents()));
    }

    /**
     * Create hash
     * @param $postData
     * @return string
     */
    protected function createHash($postData)
    {
        $hash = null;
        ksort($postData);
        foreach ($postData as $key => $val) {
            $hash .= strlen($val) . $val;
        }

        return hash_hmac("md5", $hash, $this->getData()->getSecretKey());
    }
}
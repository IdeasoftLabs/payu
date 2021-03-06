<?php
namespace IdeaSoft\PayU\Request;

use IdeaSoft\PayU\Parameter\ParameterInterface;
use IdeaSoft\PayU\Parameter\PayWithTokenParam;
use IdeaSoft\PayU\Parameter\Model\OrderItem;
use IdeaSoft\PayU\Response\PayWithTokenResponse;

/**
 * Class PayWithTokenRequest
 * @package IdeaSoft\PayU\Request
 */
class PayWithTokenRequest extends AbstractRequest
{
    /**
     * Prepare data
     * @param ParameterInterface $parameter
     * @return mixed
     */
    public function prepareData(ParameterInterface $parameter)
    {
        /** @var PayWithTokenParam $parameter */
        $params['MERCHANT'] = $parameter->getMerchant();
        $params['ORDER_REF'] = $parameter->getOrderRef();
        $params['ORDER_DATE'] = $parameter->getOrderDate();
        $params['PRICES_CURRENCY'] = $parameter->getCurrency();
        $params['SELECTED_INSTALLMENTS_NUMBER'] = $parameter->getInstallment();
        $params['CLIENT_IP'] = $parameter->getIpAddress();
        $params['BILL_LNAME'] = $parameter->getBillingAddress()->getLastName();
        $params['BILL_FNAME'] = $parameter->getBillingAddress()->getFirstName();
        $params['BILL_EMAIL'] = $parameter->getBillingAddress()->getEmail();
        $params['BILL_PHONE'] = $parameter->getBillingAddress()->getPhone();
        $params['BILL_COUNTRYCODE'] = $parameter->getBillingAddress()->getCountryCode();
        $params['BILL_ZIPCODE'] = $parameter->getBillingAddress()->getZipCode();
        $params['BILL_ADDRESS'] = $parameter->getBillingAddress()->getAddress();
        $params['BILL_ADDRESS2'] = $parameter->getBillingAddress()->getAddress2();
        $params['BILL_CITY'] = $parameter->getBillingAddress()->getCity();
        $params['BILL_STATE'] = $parameter->getBillingAddress()->getState();
        $params['BILL_FAX'] = $parameter->getBillingAddress()->getFax();
        $params['DELIVERY_LNAME'] = $parameter->getDeliveryAddress()->getLastName();
        $params['DELIVERY_FNAME'] = $parameter->getDeliveryAddress()->getFirstName();
        $params['DELIVERY_EMAIL'] = $parameter->getDeliveryAddress()->getEmail();
        $params['DELIVERY_PHONE'] = $parameter->getDeliveryAddress()->getPhone();
        $params['DELIVERY_ADDRESS'] = $parameter->getDeliveryAddress()->getAddress();
        $params['DELIVERY_ADDRESS2'] = $parameter->getDeliveryAddress()->getAddress2();
        $params['DELIVERY_ZIPCODE'] = $parameter->getDeliveryAddress()->getZipCode();
        $params['DELIVERY_CITY'] = $parameter->getDeliveryAddress()->getCity();
        $params['DELIVERY_STATE'] = $parameter->getDeliveryAddress()->getState();
        $params['DELIVERY_COUNTRYCODE'] = $parameter->getDeliveryAddress()->getCountryCode();
        $params['DELIVERY_COMPANY'] = $parameter->getDeliveryAddress()->getCompany();
        $params['CC_TOKEN'] = $parameter->getToken();
        $params['PAY_METHOD'] = 'CCVISAMC';
        $params['CC_NUMBER'] = "";
        $params['EXP_MONTH'] = "";
        $params['EXP_YEAR'] = "";
        $params['CC_CVV'] = "";
        $params['CC_OWNER'] = "";

        $i = 0;
        /** @var OrderItem $orderItem */
        foreach ($parameter->getOrderItems() as $orderItem) {
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
     * @param ParameterInterface $parameter
     * @return PayWithTokenResponse
     */
    public function send(ParameterInterface $parameter)
    {
        /** @var PayWithTokenParam $parameter */
        $postData = $this->prepareData($parameter);
        $postData["ORDER_HASH"] = $this->createHash($postData, $parameter->getSecretKey());
        $response = $this->getClient()->request('POST', $parameter->getPostUrl(), ['form_params' => $postData]);
        return new PayWithTokenResponse(@simplexml_load_string($response->getBody()->getContents()));
    }
}
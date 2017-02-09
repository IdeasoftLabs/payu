<?php
namespace IdeaSoft\PayU\Request;

use IdeaSoft\PayU\Parameter\CreateTokenParam;
use IdeaSoft\PayU\Parameter\Model\OrderItem;
use IdeaSoft\PayU\Response\CreateTokenResponse;

/**
 * Class CreateTokenRequest
 * @package IdeaSoft\PayU\Request
 */
class CreateTokenRequest extends AbstractRequest
{
    /**
     * Prepare data
     * @param CreateTokenParam $data
     * @return mixed
     */
    public function prepareData(CreateTokenParam $data)
    {
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
        $params['CC_NUMBER'] = $data->getCreditCard()->getNumber();
        $params['EXP_MONTH'] = $data->getCreditCard()->getExpiryMonth();
        $params['EXP_YEAR'] = $data->getCreditCard()->getExpiryYear();
        $params['CC_CVV'] = $data->getCreditCard()->getCvv();
        $params['CC_OWNER'] = $data->getCreditCard()->getHolderName();
        $params['LU_ENABLE_TOKEN'] = 1;

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
     * @param CreateTokenParam $createTokenParam
     * @return CreateTokenResponse
     */
    public function send(CreateTokenParam $createTokenParam)
    {
        $postData = $this->prepareData($createTokenParam);
        $postData["ORDER_HASH"] = $this->createHash($postData, $createTokenParam->getSecretKey());
        $response = $this->getClient()->request('POST', $createTokenParam->getPostUrl(), ['form_params' => $postData]);
        return new CreateTokenResponse(@simplexml_load_string($response->getBody()->getContents()));
    }
}
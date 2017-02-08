<?php
namespace IdeasoftLabs\PayU\Test;

use IdeasoftLabs\PayU\Parameter\Model\BillingAddress;
use IdeasoftLabs\PayU\Parameter\Model\DeliveryAddress;
use IdeasoftLabs\PayU\Parameter\Model\OrderItem;
use IdeasoftLabs\PayU\Parameter\PayWithTokenParam;
use IdeasoftLabs\PayU\Request\PayWithTokenRequest;

/**
 * Class PayWithTokenRequestTest
 * @package IdeasoftLabs\PayU\Test\IdeasoftLabs\PayU
 */
class PayWithTokenRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test prepareData
     */
    public function testPrepareData()
    {
        $param = $this->getParam();

        // request
        $payWithTokenRequest = new PayWithTokenRequest($param);
        $data = $payWithTokenRequest->prepareData();
        $this->assertEquals($data['PAY_METHOD'], 'CCVISAMC');
        $this->assertEquals($data['MERCHANT'], $param->getMerchant());
        $this->assertEquals($data['CC_NUMBER'], '');
        $this->assertEquals($data['CC_OWNER'], '');
        $this->assertEquals($data['CC_CVV'], '');
        $this->assertEquals($data['EXP_MONTH'], '');
        $this->assertEquals($data['EXP_YEAR'], '');
        $this->assertEquals($data['ORDER_REF'], $param->getOrderRef());
        $this->assertEquals($data['PRICES_CURRENCY'], $param->getCurrency());
        $this->assertEquals($data['SELECTED_INSTALLMENTS_NUMBER'], $param->getInstallment());
        $this->assertEquals($data['CLIENT_IP'], $param->getIpAddress());
        $this->assertEquals($data['BILL_LNAME'], $param->getBillingAddress()->getLastName());
        $this->assertEquals($data['BILL_FNAME'], $param->getBillingAddress()->getFirstName());
        $this->assertEquals($data['BILL_EMAIL'], $param->getBillingAddress()->getEmail());
        $this->assertEquals($data['BILL_PHONE'], $param->getBillingAddress()->getPhone());
        $this->assertEquals($data['BILL_COUNTRYCODE'], $param->getBillingAddress()->getCountryCode());
        $this->assertEquals($data['BILL_ZIPCODE'], $param->getBillingAddress()->getZipCode());
        $this->assertEquals($data['BILL_ADDRESS'], $param->getBillingAddress()->getAddress());
        $this->assertEquals($data['BILL_ADDRESS2'], $param->getBillingAddress()->getAddress2());
        $this->assertEquals($data['BILL_CITY'], $param->getBillingAddress()->getCity());
        $this->assertEquals($data['BILL_STATE'], $param->getBillingAddress()->getState());
        $this->assertEquals($data['BILL_FAX'], $param->getBillingAddress()->getFax());
        $this->assertEquals($data['DELIVERY_LNAME'], $param->getDeliveryAddress()->getLastName());
        $this->assertEquals($data['DELIVERY_FNAME'], $param->getDeliveryAddress()->getFirstName());
        $this->assertEquals($data['DELIVERY_EMAIL'], $param->getDeliveryAddress()->getEmail());
        $this->assertEquals($data['DELIVERY_PHONE'], $param->getDeliveryAddress()->getPhone());
        $this->assertEquals($data['DELIVERY_COUNTRYCODE'], $param->getDeliveryAddress()->getCountryCode());
        $this->assertEquals($data['DELIVERY_ZIPCODE'], $param->getDeliveryAddress()->getZipCode());
        $this->assertEquals($data['DELIVERY_ADDRESS'], $param->getDeliveryAddress()->getAddress());
        $this->assertEquals($data['DELIVERY_ADDRESS2'], $param->getDeliveryAddress()->getAddress2());
        $this->assertEquals($data['DELIVERY_CITY'], $param->getDeliveryAddress()->getCity());
        $this->assertEquals($data['DELIVERY_STATE'], $param->getDeliveryAddress()->getState());
        $this->assertEquals($data['CC_TOKEN'], 'TOKEN');
    }

    /**
     * Test send
     */
    public function testSend()
    {
        $data = $this->getParam();

        // mocked client
        $responseData = [
            'SUCCESS' => 'STATUS',
            '123' => 'REFNO',
            '00' => 'PROCRETURNCODE',
            '' => 'ERRORMESSAGE'
        ];
        $xml = new \SimpleXMLElement('<root/>');
        array_walk_recursive($responseData, array($xml, 'addChild'));

        // mock guzzle response contents
        $body = $this->getMockBuilder('\\GuzzleHttp\\Psr7\\Stream')
            ->disableOriginalConstructor()
            ->setMethods(['getContents'])
            ->getMock();

        $body->expects($this->once())
            ->method('getContents')
            ->willReturn($xml->asXML());

        // mock guzzle response body
        $response = $this->getMockBuilder('\\GuzzleHttp\\Psr7\\Response')
            ->disableOriginalConstructor()
            ->setMethods(['getBody'])
            ->getMock();

        $response->expects($this->once())
            ->method('getBody')
            ->willReturn($body);

        // mock guzzle request
        $client = $this->getMockBuilder('\\GuzzleHttp\\Client')
            ->disableOriginalConstructor()
            ->setMethods(['request'])
            ->getMock();

        $client->expects($this->once())
            ->method('request')
            ->willReturn($response);


        // mocked request
        $payWithTokenRequest = $this->getMockBuilder('\\IdeasoftLabs\\PayU\\Request\\PayWithTokenRequest')->disableOriginalConstructor()->setMethods(['getData', 'createHash'])->getMock();
        $payWithTokenRequest->expects($this->any())->method('getData')->willReturn($data);
        $payWithTokenRequest->expects($this->any())->method('createHash')->willReturn('HASH');

        // send
        $payWithTokenResponse = $payWithTokenRequest->send($client);
        $this->assertEquals($payWithTokenResponse->isSuccessful(), true);
        $this->assertEquals($payWithTokenResponse->getRefNo(), '123');
        $this->assertEquals($payWithTokenResponse->getErrorCode(), '00');
        $this->assertEquals($payWithTokenResponse->getErrorMessage(), '');
    }

    /**
     * Get param
     * @return PayWithTokenParam
     */
    private function getParam()
    {
        $billingAddress = new BillingAddress();
        $billingAddress->setFirstName('Murat');
        $billingAddress->setLastName('SAÇ');
        $billingAddress->setEmail('your@mail.com');
        $billingAddress->setCity('City');
        $billingAddress->setZipCode('12345');
        $billingAddress->setAddress('Billing address');
        $billingAddress->setAddress2('Billing address');
        $billingAddress->setPhone('13556778900');
        $billingAddress->setCountryCode('TR');
        $billingAddress->setState('State / Dept.');
        $billingAddress->setFax('1234567890');

        $deliveryAddress = new DeliveryAddress();
        $deliveryAddress->setFirstName('Murat');
        $deliveryAddress->setLastName('SAÇ');
        $deliveryAddress->setEmail('your@mail.com');
        $deliveryAddress->setCity('City');
        $deliveryAddress->setZipCode('12345');
        $deliveryAddress->setAddress('Delivery Address');
        $deliveryAddress->setAddress2('Delivery Address');
        $deliveryAddress->setPhone('1234567890');
        $deliveryAddress->setCountryCode('TR');
        $deliveryAddress->setState('State / Dept.');
        $deliveryAddress->setFax('1234567890');

        $orderItem = new OrderItem();
        $orderItem->setName('Ticket1');
        $orderItem->setCode('TCK1');
        $orderItem->setInfo('Barcelona flight');
        $orderItem->setPrice('100');
        $orderItem->setVat('qw2');
        $orderItem->setQuantity('1');

        $param = new PayWithTokenParam();
        $param->setPostUrl('https://secure.payu.com.tr/order/alu/v3');
        $param->setSecretKey('SECRET_KEY');
        $param->setMerchant('OPU_TEST');
        $param->setIpAddress('127.0.0.1');
        $param->setOrderRef(999990002);
        $param->setOrderDate(gmdate('Y-m-d H:i:s'));
        $param->setCurrency('TRY');
        $param->setInstallment('4');
        $param->setBillingAddress($billingAddress);
        $param->setDeliveryAddress($deliveryAddress);
        $param->addOrderItem($orderItem);
        $param->setToken('TOKEN');

        return $param;
    }
}

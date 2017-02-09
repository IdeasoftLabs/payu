<?php
require_once __DIR__ . '/../vendor/autoload.php';

use IdeaSoft\PayU\Parameter\Model\CreditCard;
use IdeaSoft\PayU\Parameter\Model\BillingAddress;
use IdeaSoft\PayU\Parameter\Model\DeliveryAddress;
use IdeaSoft\PayU\Parameter\Model\OrderItem;
use IdeaSoft\PayU\Parameter\CreateTokenParam;
use IdeaSoft\PayU\Request\CreateTokenRequest;

$creditCard = new CreditCard();
$creditCard->setHolderName('Murat SAÇ');
$creditCard->setNumber('4355084355084358');
$creditCard->setExpiryMonth('12');
$creditCard->setExpiryYear('2018');
$creditCard->setCvv('000');

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

$param = new CreateTokenParam();
$param->setPostUrl('https://secure.payu.com.tr/order/alu/v3');
$param->setSecretKey('SECRET_KEY');
$param->setMerchant('OPU_TEST');
$param->setIpAddress('127.0.0.1');
$param->setOrderRef(999990002);
$param->setOrderDate(gmdate('Y-m-d H:i:s'));
$param->setCurrency('TRY');
$param->setInstallment('4');
$param->setCreditCard($creditCard);
$param->setBillingAddress($billingAddress);
$param->setDeliveryAddress($deliveryAddress);
$param->addOrderItem($orderItem);

// request
$request = new CreateTokenRequest(new \GuzzleHttp\Client());
/** @var \IdeaSoft\PayU\Response\CreateTokenResponse $response */
$response = $request->send($param);
echo "TOKEN : ".$response->getTokenHash();

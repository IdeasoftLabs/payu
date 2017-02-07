<?php
require_once __DIR__ . '/../vendor/autoload.php';

use IdeasoftLabs\PayU\Parameter\Model\CreditCard;
use IdeasoftLabs\PayU\Parameter\Model\BillingAddress;
use IdeasoftLabs\PayU\Parameter\Model\DeliveryAddress;
use IdeasoftLabs\PayU\Parameter\Model\OrderItem;
use IdeasoftLabs\PayU\Parameter\CreateTokenParam;
use IdeasoftLabs\PayU\Request\CreateTokenRequest;

$creditCard = new CreditCard();
$creditCard->setHolderName('IdeaSoft labs');
$creditCard->setNumber('4355084355084358');
$creditCard->setExpiryMonth('12');
$creditCard->setExpiryYear('2018');
$creditCard->setCvv('000');

$billingAddress = new BillingAddress();
$billingAddress->setFirstName('Murat');
$billingAddress->setLastName('Saç');
$billingAddress->setEmail('murat.sac@ideasoft.com.tr');
$billingAddress->setCity('istanbul');
$billingAddress->setZipCode('34876');
$billingAddress->setAddress('Cumhuriyet mah. Bahariye sok. No:30 D/2 Yakacık Kartal');
$billingAddress->setAddress2('D3');
$billingAddress->setPhone('05062446405');
$billingAddress->setCountryCode('TR');
$billingAddress->setState('State');
$billingAddress->setFax('1234567890');

$deliveryAddress = new DeliveryAddress();
$deliveryAddress->setFirstName('Murat');
$deliveryAddress->setLastName('Saç');
$deliveryAddress->setEmail('murat.sac@ideasoft.com.tr');
$deliveryAddress->setCity('istanbul');
$deliveryAddress->setZipCode('34876');
$deliveryAddress->setAddress('Cumhuriyet mah. Bahariye sok. No:30 D/2 Yakacık Kartal');
$deliveryAddress->setAddress2('D3');
$deliveryAddress->setPhone('05062446405');
$deliveryAddress->setCountryCode('TR');
$deliveryAddress->setState('State');
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
$param->setOrderRef('988012');
$param->setOrderDate(gmdate('Y-m-d H:i:s'));
$param->setCurrency('TRY');
$param->setInstallment('1');
$param->setCreditCard($creditCard);
$param->setBillingAddress($billingAddress);
$param->setDeliveryAddress($deliveryAddress);
$param->addOrderItem($orderItem);

// request
$request = new CreateTokenRequest($param);
$response = $request->send();
var_dump($response);


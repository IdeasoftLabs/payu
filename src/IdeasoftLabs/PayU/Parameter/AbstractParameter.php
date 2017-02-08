<?php
namespace IdeasoftLabs\PayU\Parameter;

use IdeasoftLabs\PayU\Parameter\Model\BillingAddress;
use IdeasoftLabs\PayU\Parameter\Model\CreditCard;
use IdeasoftLabs\PayU\Parameter\Model\DeliveryAddress;
use IdeasoftLabs\PayU\Parameter\Model\OrderItem;

/**
 * Class AbstractParameter
 * @package IdeasoftLabs\PayU\Parameter
 */
abstract class AbstractParameter implements ParameterInterface
{
    /**
     * @var string
     */
    private $merchant;

    /**
     * @var string
     */
    private $secretKey;

    /**
     * @var string
     */
    private $postUrl;

    /**
     * @var integer
     */
    private $installment;

    /**
     * @var string
     */
    private $orderRef;

    /**
     * @var string
     */
    private $orderDate;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $ipAddress;

    /**
     * @var OrderItem[]
     */
    private $orderItems;

    /**
     * @var BillingAddress
     */
    private $billingAddress;

    /**
     * @var DeliveryAddress
     */
    private $deliveryAddress;

    /**
     * @var CreditCard
     */
    private $creditCard;

    /**
     * @return string
     */
    public function getMerchant()
    {
        return $this->merchant;
    }

    /**
     * @param string $merchant
     */
    public function setMerchant($merchant)
    {
        $this->merchant = $merchant;
    }

    /**
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * @param string $secretKey
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * @return string
     */
    public function getPostUrl()
    {
        return $this->postUrl;
    }

    /**
     * @param string $postUrl
     */
    public function setPostUrl($postUrl)
    {
        $this->postUrl = $postUrl;
    }

    /**
     * @return string
     */
    public function getOrderRef()
    {
        return $this->orderRef;
    }

    /**
     * @param string $orderRef
     */
    public function setOrderRef($orderRef)
    {
        $this->orderRef = $orderRef;
    }

    /**
     * @return string
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * @param string $orderDate
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @param string $ipAddress
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
    }

    /**
     * @return Model\OrderItem[]
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }

    /**
     * Add OrderItem
     * @param OrderItem $orderItem
     */
    public function addOrderItem(OrderItem $orderItem)
    {
        $this->orderItems[] = $orderItem;
    }

    /**
     * @return BillingAddress
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @param BillingAddress $billingAddress
     */
    public function setBillingAddress(BillingAddress $billingAddress)
    {
        $this->billingAddress = $billingAddress;
    }

    /**
     * @return DeliveryAddress
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * @param DeliveryAddress $deliveryAddress
     */
    public function setDeliveryAddress(DeliveryAddress $deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * @return CreditCard
     */
    public function getCreditCard()
    {
        return $this->creditCard;
    }

    /**
     * @param CreditCard $creditCard
     */
    public function setCreditCard(CreditCard $creditCard)
    {
        $this->creditCard = $creditCard;
    }

    /**
     * @return int
     */
    public function getInstallment()
    {
        return $this->installment;
    }

    /**
     * @param int $installment
     */
    public function setInstallment($installment)
    {
        $this->installment = $installment;
    }
}

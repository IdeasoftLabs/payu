<?php
namespace IdeasoftLabs\PayU\Parameter;

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
}

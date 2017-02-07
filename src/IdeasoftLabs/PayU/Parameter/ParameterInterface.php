<?php
namespace IdeasoftLabs\PayU\Parameter;

/**
 * Interface ParameterInterface
 * @package IdeasoftLabs\PayU\Parameter
 */
interface ParameterInterface
{
    public function setSecretKey($secretKey);

    public function getSecretKey();

    public function setMerchant($merchant);

    public function getMerchant();

    public function setPostUrl($postUrl);

    public function getPostUrl();
}
<?php
namespace IdeasoftLabs\PayU\Parameter;

/**
 * Class PayWithTokenParam
 * @package IdeasoftLabs\PayU\Parameter
 */
class PayWithTokenParam extends AbstractParameter
{
    /**
     * @var string
     */
    private $token;

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }
}
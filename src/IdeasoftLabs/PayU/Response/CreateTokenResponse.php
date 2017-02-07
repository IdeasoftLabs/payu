<?php
namespace PayU\Response;

/**
 * Class CreateTokenResponse
 * @package PayU\Response
 */
class CreateTokenResponse extends AbstractResponse
{
    /**
     * is successful
     * @return bool
     */
    public function isSuccessful()
    {
        if(strval($this->getResponse()->STATUS) == 'SUCCESS'){
            return true;
        }
        return false;
    }

    /**
     * Get token hash
     * @return mixed
     */
    public function getTokenHash()
    {
        return strval($this->getResponse()->TOKEN_HASH);
    }

    /**
     * Get error code
     * @return string
     */
    public function getErrorCode()
    {
        return strval($this->getResponse()->PROCRETURNCODE);
    }

    /**
     * Get error message
     * @return string
     */
    public function getErrorMessage()
    {
        return strval($this->getResponse()->ERRORMESSAGE);
    }
}
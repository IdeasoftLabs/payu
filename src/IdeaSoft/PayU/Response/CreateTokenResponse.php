<?php
namespace IdeaSoft\PayU\Response;

/**
 * Class CreateTokenResponse
 * @package IdeaSoft\PayU\Response
 */
class CreateTokenResponse extends AbstractResponse
{
    /**
     * is successful
     * @return bool
     */
    public function isSuccessful()
    {
        if(strval($this->getData()->STATUS) == 'SUCCESS'){
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
        return strval($this->getData()->TOKEN_HASH);
    }

    /**
     * Get error code
     * @return string
     */
    public function getErrorCode()
    {
        return strval($this->getData()->PROCRETURNCODE);
    }

    /**
     * Get error message
     * @return string
     */
    public function getErrorMessage()
    {
        return strval($this->getData()->ERRORMESSAGE);
    }
}
<?php
namespace IdeaSoft\PayU\Response;

/**
 * Class PayWithTokenResponse
 * @package IdeaSoft\PayU\Response
 */
class PayWithTokenResponse extends AbstractResponse
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

    /**
     * Get ref no
     * @return string
     */
    public function getRefNo()
    {
        return strval($this->getResponse()->REFNO);
    }
}
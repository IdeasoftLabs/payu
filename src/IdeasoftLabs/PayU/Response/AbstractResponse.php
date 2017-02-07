<?php
namespace PayU\Response;

/**
 * Class AbstractResponse
 * @package PayU\Response
 */
abstract class AbstractResponse
{
    /**
     * @var mixed
     */
    protected $response;

    /**
     * AbstractResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {
        $this->setResponse($response);
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }
}
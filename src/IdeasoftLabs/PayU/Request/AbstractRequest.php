<?php
namespace IdeasoftLabs\PayU\Request;

use IdeasoftLabs\PayU\Parameter\ParameterInterface;

/**
 * Class AbstractRequest
 * @package IdeasoftLabs\PayU\Request
 */
abstract class AbstractRequest
{
    /**
     * @var ParameterInterface
     */
    private $data;

    /**
     * AbstractRequest constructor.
     * @param ParameterInterface $data
     */
    public function __construct(ParameterInterface $data)
    {
        $this->data =  $data;
    }

    /**
     * @return ParameterInterface
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param ParameterInterface $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}
<?php
namespace IdeaSoft\PayU\Response;

/**
 * Class AbstractResponse
 * @package IdeaSoft\PayU\Response
 */
abstract class AbstractResponse
{
    /**
     * @var mixed
     */
    protected $data;

    /**
     * AbstractResponse constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->setData($data);
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}
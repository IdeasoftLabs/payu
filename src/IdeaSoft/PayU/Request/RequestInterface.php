<?php
namespace IdeaSoft\PayU\Request;

use IdeaSoft\PayU\Parameter\ParameterInterface;

/**
 * Interface RequestInterface
 * @package IdeaSoft\PayU\Request
 */
interface RequestInterface
{
    public function prepareData(ParameterInterface $parameter);

    public function send(ParameterInterface $parameter);
}
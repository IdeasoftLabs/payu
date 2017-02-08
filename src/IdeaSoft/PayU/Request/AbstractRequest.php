<?php
namespace IdeaSoft\PayU\Request;

use IdeaSoft\PayU\Parameter\ParameterInterface;
use GuzzleHttp\Client;

/**
 * Class AbstractRequest
 * @package IdeaSoft\PayU\Request
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
        $this->data = $data;
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


    /**
     * Create hash
     * @param $postData
     * @return string
     */
    protected function createHash($postData)
    {
        $hash = null;
        ksort($postData);
        foreach ($postData as $key => $val) {
            $hash .= strlen($val) . $val;
        }

        return hash_hmac("md5", $hash, $this->getData()->getSecretKey());
    }

    /**
     * Send request
     * @param null $client
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function send($client = null)
    {
        $postData = $this->prepareData();
        $postData["ORDER_HASH"] = $this->createHash($postData);

        // send
        if ($client === null) {
            $client = new Client();
        }
        $response = $client->request('POST', $this->getData()->getPostUrl(), ['form_params' => $postData]);

        return $response;
    }
}
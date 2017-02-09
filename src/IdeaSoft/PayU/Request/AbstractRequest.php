<?php
namespace IdeaSoft\PayU\Request;

use GuzzleHttp\Client;

/**
 * Class AbstractRequest
 * @package IdeaSoft\PayU\Request
 */
abstract class AbstractRequest implements RequestInterface
{
    /**
     * Client
     * @var Client
     */
    private $client;

    /**
     * AbstractRequest constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->setClient($client);
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Create hash
     * @param $postData
     * @param $secretKey
     * @return string
     */
    protected function createHash($postData, $secretKey)
    {
        $hash = null;
        ksort($postData);
        foreach ($postData as $key => $val) {
            $hash .= strlen($val) . $val;
        }

        return hash_hmac("md5", $hash, $secretKey);
    }
}
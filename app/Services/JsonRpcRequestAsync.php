<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class JsonRpcRequestAsync
{

    /* @var string */
    public $endpoint;
    /* @var null|integer|string */
    public $id;
    /* @var string */
    public $method;
    /* @var array */
    public $params;

    public function __construct($method, $params)
    {
        $name = 'ACTIVITY_URL';

        $endpoint = env($name);

        if (!$endpoint) {
            throw new \InvalidArgumentException("Required parameter \"{$name}\" in .env");
        }

        $this->endpoint = $endpoint;
        $this->method = $method;
        $this->params = $params;
    }

    public function run() {

        $client = new Client();

        return $client->getAsync($this->endpoint, [
//            RequestOptions::DELAY => 1,
            RequestOptions::JSON => [
                'jsonrpc' => '2.0',
                'method' => $this->method,
                'params' => $this->params,
                'id' => $this->id,
            ],
        ]);
    }

}

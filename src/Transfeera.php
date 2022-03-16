<?php

namespace Cuponeria\TransfeeraPhpSdk;

use Cuponeria\TransfeeraPhpSdk\Credentials;

class Transfeera
{
    protected $credentials;

    protected $client;

    public function __construct($agent, $secret, $isSandbox = false)
    {
        $credentials =  new Credentials($agent, $secret);
        $this->client = new HttpClient($credentials, $isSandbox);
    }

    public function batch()
    {
        return new Batch($this->client);
    }

    public function transfer()
    {
        return new Transfer($this->client);
    }
}
<?php

namespace Cuponeria\TransfeeraPhpSdk;

class Credentials
{

    protected $agent;
    private $secret;

    public function __construct($agent, $secret, $isProduction = true)
    {
        $this->agent = $agent;
        $this->secret = $secret;
    }

    public function getInfo()
    {
        return [
            'User-Agent' => $this->agent,
            'Authorization' => $this->secret
        ];
    }
}
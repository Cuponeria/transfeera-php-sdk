<?php

namespace Cuponeria\TransfeeraPhpSdk;

class Client
{

    protected $credentials;
    protected $url;

    public function __construct(Credentials $credentials, $isSandbox = false)
    {
        $this->credentials = $credentials;
        $this->url = $this->getUrl($isSandbox);
    }

    private function getUrl($isSandbox)
    {
        if ($isSandbox)
        {
            return 'https://api-sandbox.transfeera.com';
        }

        return 'https://api.transfeera.com';
    }

    public function query()
    {
        
    }
}
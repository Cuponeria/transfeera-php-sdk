<?php

namespace Cuponeria\TransfeeraPhpSdk;


class Batch
{

    private $client;

    private $base_url;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }
   
    public function create()
    {
        $this->client->query(*);
    }
}
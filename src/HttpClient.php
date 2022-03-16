<?php

namespace Cuponeria\TransfeeraPhpSdk;

use Cuponeria\TransfeeraPhpSdk\Excepetions\LoginException;
use \GuzzleHttp\Client;

class HttpClient
{

    /**
     * Credencial class
     *
     * @var Credentials
     */
    protected $credentials;

    /**
     * Base URI
     *
     * @var String
     */
    protected $uri;

    protected $token;

    protected $isSandbox;

    public function __construct(Credentials $credentials, $isSandbox = false)
    {
        $this->credentials = $credentials;
        $this->isSandbox = $isSandbox;
        $this->client = new Client();
    }

    private function getUrl()
    {
        if ($this->isSandbox === true)
        {
            return 'https://api-sandbox.transfeera.com';
        }

        return 'https://api.transfeera.com';
    }

    protected function login()
    {
        $url = 'https://login-api.transfeera.com/authorization';

        if ($this->isSandbox) {
            $url = 'https://login-api-sandbox.transfeera.com/authorization';
        }

        $response = $this->client->request(
            'POST',
            $url,
            [
                'headers' => [
                    $this->credentials->getInfo(),
                ],
            ]
        )->getBody()
        ->getContents();
        $responseData = json_decode($response, true);

        if (isset($responseData['error'])) {
            throw new LoginException(json_encode($responseData));
        }

        $this->token = $responseData['token'];
    }

    public function query($method, $route, $body)
    {
        $url = $this->getUrl() . '/' . $route;

        $response = $this->client->request(
            $method,
            $url,
            [
                'allow_redirects' => true,
                'protocols'       => ['https'],
                'headers' => [
                    'Authorization' => "Bearer {$this->token}",
                    'User-Agent' => $this->credentials->getAgent()
                ],
                'body' => $body 
            ]
        )->getBody()->getContents();

        return json_decode($response, true);
    }
}
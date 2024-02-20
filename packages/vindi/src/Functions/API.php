<?php
namespace CodemaxBR\Vindi\Functions;

use GuzzleHttp\Client;

class API
{
    private $endpoint               = 'https://app.vindi.com.br/api';
    private $endpoint_sandbox       = 'https://sandbox-app.vindi.com.br/api/';
    private $version                = 'v1';
    private $ambiente               = 'sandbox';
    private $client;

    function __construct($apikey, $ambiente)
    {
        $this->ambiente = $ambiente;

        $this->client = new Client([
            'base_uri' => $this->getEndpoint() . "/",
            'auth' => [$apikey, '', 'BASIC'],
            'headers' => [
                'Content-Type' => 'application/json',
                'User-Agent'   => trim("CodemaxBR/VindiService; " . url('/')),
            ],
            'timeout' => 60,
            'exceptions' => false
        ]);
    }

    private function getEndpoint()
    {
        if($this->ambiente == 'sandbox'){
            return $this->endpoint_sandbox . '/' . $this->version;
        }

        return $this->endpoint . '/' . $this->version;
    }

    public function getRequest($uri, array $options = [])
    {
        return $this->request('GET', $uri, $options);
    }
    public function postRequest($uri, array $options = [])
    {
        return $this->request('POST', $uri, $options);
    }
    public function putRequest($uri, array $options = [])
    {
        return $this->request('PUT', $uri, $options);
    }
    public function deleteRequest($uri, array $options = [])
    {
        return $this->request('DELETE', $uri, $options);
    }

    private function request($method, $uri, array $options = [])
    {
        $request = $this->client->request($method, $uri, $options);
        return $this->response($request);
    }
    private function response($response){
        return json_decode(json_encode(array_merge([
            'status' => $response->getStatusCode(),
            'headers' => $response->getHeaders(),
        ], json_decode($response->getBody()->getContents(), true))));
    }
}
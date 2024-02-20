<?php
namespace CodemaxBR\Vindi;

class Vindi
{
    public $apiKey;
    public $env;

    public function __construct($apikey, $env)
    {
        $this->apiKey = $apikey;
        $this->env = $env;
    }

    public function setCredentials($apikey, $env){
        $this->env = $env;
        $this->apiKey = $apikey;
    }

    public function __call($method, $arguments = null)
    {
        $class = '\\CodemaxBR\Vindi\Functions\\'.ucfirst($method);

        if (!class_exists($class, true)){
            throw new \Exception("{$class} não existe.");
        }

        return new $class($this->apiKey, $this->env);
    }
}
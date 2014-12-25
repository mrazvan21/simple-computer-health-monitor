<?php

namespace App;

use Slim\Slim;

class Response implements ResponseInterface
{
    private $app;
    private $headers = array();

    public function __construct(Slim $app)
    {
        $this->app = $app;
    }

    public function setHeader($name, $value)
    {
        $this->headers[$name] = $value;
    }

    public function send(array $result)
    {
        $this->sendHeaders();
        return json_encode($result);
    }

    private function sendHeaders()
    {
        foreach ($this->headers as $value => $name) {
            $this->app->response()->header($value, $name);
        }
    }
} 
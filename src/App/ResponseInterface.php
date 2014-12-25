<?php

namespace App;

use Slim\Slim;

interface ResponseInterface
{
    public function __construct(Slim $app);
    public function setHeader($name, $value);
    public function send(array $array);
} 
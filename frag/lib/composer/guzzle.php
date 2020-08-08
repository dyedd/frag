<?php
namespace frag\lib\composer;
use GuzzleHttp\Client;
class guzzle extends Client
{
    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }
}

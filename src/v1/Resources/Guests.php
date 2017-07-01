<?php

namespace PHS\v1\Resources;

use PHS\v1\Resource;
use PHS\v1\API;

class Guests extends Resource
{
    public function __construct(API $api)
    {
        parent::__construct($api);
    }
    
    public function get($name)
    {
        return $this->api->sendGet("guests/{$name}");
    }
}

<?php

namespace PHS\v1;

use PHS\v1\API;

class BaseResource
{
    protected $api;
    
    public function __construct(API $api)
    {
        $this->api = $api;
    }
}

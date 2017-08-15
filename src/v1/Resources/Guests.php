<?php

namespace PHS\v1\Resources;

use PHS\v1\BaseResource;
use PHS\v1\API;

class Guests extends BaseResource
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

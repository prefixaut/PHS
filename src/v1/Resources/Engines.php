<?php

namespace PHS\v1\Resources;

use PHS\v1\BaseResource;
use PHS\v1\API;

class Engines extends BaseResource
{
    public function __construct(API $api)
    {
        parent::__construct($api);
    }
    
    public function all($args = [])
    {
        return $this->api->sendGet('engines', $args);
    }
    
    public function get($id)
    {
        return $this->api->sendGet("engines/{$id}");
    }
}

<?php

namespace PHS\v1\Resources;

use PHS\v1\BaseResource;
use PHS\v1\API;

class Categories extends BaseResource
{
    public function __construct(API $api)
    {
        parent::__construct($api);
    }
    
    public function get($id)
    {
        return $this->api->sendGet("categories/{$id}");
    }
    
    public function variables($id, $args = [])
    {
        return $this->api->sendGet("categories/{$id}/variables", $args);
    }
    
    public function records($id, $args = [])
    {
        return $this->api->sendGet("categories/{$id}/records", $args);
    }
}

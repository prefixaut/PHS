<?php

namespace PHS\v1\Resources;

use PHS\v1\BaseResource;
use PHS\v1\API;

class Levels extends BaseResource
{
    public function __construct(API $api)
    {
        parent::__construct($api);
    }
    
    public function get($id)
    {
        return $this->api->sendGet("levels/{$id}");
    }
    
    public function categories($id, $args = [])
    {
        return $this->api->sendGet("levels/{$id}/categories", $args);
    }
    
    public function variables($id, $args = [])
    {
        return $this->api->sendGet("levels/{$id}/variables", $args);
    }
    
    public function records($id, $args = [])
    {
        return $this->api->sendGet("levels/{$id}/records", $args);
    }
}

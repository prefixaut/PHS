<?php

namespace PHS\v1\Resources;

use PHS\v1\BaseResource;
use PHS\v1\API;

class Series extends BaseResource
{
    public function __construct(API $api)
    {
        parent::__construct($api);
    }
    
    public function all($args = [])
    {
        return $this->api->sendGet('series', $args);
    }
    
    public function get($id)
    {
        return $this->api->sendGet("series/{$id}");
    }
    
    public function games($id, $args = [])
    {
        return $this->api->sendGet("series/{$id}/games", $args);
    }
}

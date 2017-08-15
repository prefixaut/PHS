<?php

namespace PHS\v1\Resources;

use PHS\v1\BaseResource;
use PHS\v1\API;

class Games extends BaseResource
{
    public function __construct(API $api)
    {
        parent::__construct($api);
    }
    
    public function all($args = [])
    {
        return $this->api->sendGet('games', $args);
    }
    
    public function get($id)
    {
        return $this->api->sendGet("games/{$id}");
    }
    
    public function categories($id, $args = [])
    {
        return $this->api->sendGet("games/{$id}/categories", $args);
    }
    
    public function levels($id, $args = [])
    {
        return $this->api->sendGet("games/{$id}/levels", $args);
    }
    
    public function variables($id, $args = [])
    {
        return $this->api->sendGet("games/{$id}/variables", $args);
    }
    
    public function derived($id)
    {
        return $this->api->sendGet("games/{$id}/derived-games");
    }
    
    public function records($id, $args = [])
    {
        return $this->api->sendGet("games/{$id}/records", $args);
    }
}

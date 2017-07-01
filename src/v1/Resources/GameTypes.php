<?php

namespace PHS\v1\Resources;

use PHS\v1\Resource;
use PHS\v1\API;

class GameTypes extends Resource
{
    public function __construct(API $api)
    {
        parent::__construct($api);
    }
    
    public function all($args = [])
    {
        return $this->api->sendGet('gametypes', $args);
    }
    
    public function get($id, $args = [])
    {
        return $this->api->sendGet("gametypes/{$id}", $args);
    }
}

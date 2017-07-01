<?php

namespace PHS\v1\Resources;

use PHS\v1\Resource;
use PHS\v1\API;

class Leaderboards extends Resource
{
    public function __construct(API $api)
    {
        parent::__construct($api);
    }
    
    public function category($game, $category, $args = [])
    {
        return $this->api->sendGet("leaderboards/{$game}/category/{$category}", $args);
    }
    
    public function level($game, $level, $args = [])
    {
        return $this->api->sendGet("leaderboards/{$game}/level/{$level}", $args);
    }
}

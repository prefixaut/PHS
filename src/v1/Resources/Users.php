<?php

namespace PHS\v1\Resources;

use PHS\v1\BaseResource;
use PHS\v1\API;

class Users extends BaseResource
{
    public function __construct(API $api)
    {
        parent::__construct($api);
    }
    
    public function all($args = [])
    {
        return $this->api->sendGet('users', $args);
    }
    
    public function get($id)
    {
        return $this->api->sendGet("users/{$id}");
    }
    
    public function personalBests($id, $args = [])
    {
        return $this->api->sendGet("users/{$id}/personal-bests", $args);
    }
    
    public function pbs($id, $args = [])
    {
        return $this->personalBests($id, $args);
    }
}

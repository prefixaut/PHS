<?php

namespace PHS\v1\Resources;

use PHS\v1\Resource;
use PHS\v1\API;

class Profile extends Resource
{
    public function __construct(API $api)
    {
        parent::__construct($api);
    }
    
    public function get()
    {
        return $this->api->sendGet('profile', [], true);
    }
}

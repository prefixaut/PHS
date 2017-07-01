<?php

namespace PHS\v1\Resources;

use PHS\v1\Resource;
use PHS\v1\API;

class Notifications extends Resource
{
    public function __construct(API $api)
    {
        parent::__construct($api);
    }
    
    public function all($args = [])
    {
        return $this->api->sendGet('notifictions', $args);
    }
}

<?php

namespace PHS\v1\Resources;

use PHS\v1\Resource;
use PHS\v1\API;

class Variables extends Resource
{
    public function __construct(API $api)
    {
        parent::__construct($api);
    }
    
    public function get($id)
    {
        return $this->api->sendGet("variables/{$id}");
    }
}

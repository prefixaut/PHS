<?php

namespace PHS\v1\Resources;

use PHS\v1\BaseResource;
use PHS\v1\API;

class Runs extends BaseResource
{
    public function __construct(API $api)
    {
        parent::__construct($api);
    }
    
    public function all($args = [])
    {
        return $this->api->sendGet('runs', $args);
    }
    
    public function get($id)
    {
        return $this->api->sendGet("runs/{$id}");
    }
    
    public function create($run)
    {
        $data = array(
            'run'   => $run,
        );
        
        return $this->api->sendPostJson('runs', $data, [], true);
    }
}

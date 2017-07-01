<?php

namespace PHS\v1;

use PHS\v1\Resource;
use PHS\v1\Resources\Categories;
use PHS\v1\Resources\Developers;
use PHS\v1\Resources\Engines;
use PHS\v1\Resources\Games;
use PHS\v1\Resources\GameTypes;
use PHS\v1\Resources\Genres;
use PHS\v1\Resources\Guests;
use PHS\v1\Resources\Leaderboards;
use PHS\v1\Resources\Levels;
use PHS\v1\Resources\Notifications;
use PHS\v1\Resources\Platforms;
use PHS\v1\Resources\Profile;
use PHS\v1\Resources\Publishers;
use PHS\v1\Resources\Regions;
use PHS\v1\Resources\Runs;
use PHS\v1\Resources\Series;
use PHS\v1\Resources\Users;
use PHS\v1\Resources\Variables;

class API
{
    /* =========================================================================
     * ~~ Variables
     * =======================================================================*/
     
    private $baseUrl = "http://www.speedrun.com/api/v1/";
    private $resources = [];
    private $auth;
    
    /* =========================================================================
     * ~~ Constructor
     * =======================================================================*/
    
    public function __construct($auth = null)
    {
        $this->auth = $auth;
        $this->setupResources();
    }
    
    /* =========================================================================
     * ~~ Magic Functions
     * =======================================================================*/
    
    public function __get($name)
    {
        if (isset($this->resources[$name]))
            return $this->resources[$name];
    }
    
    public function __set($name, $value)
    {
        if (!is_string($name) || !($name instanceof Resource))
            return;
        
        $this->resources[$name] = $value;
    }
    
    public function __isset($name)
    {
        return isset($this->resources[$name]);
    }
    
    public function __unset($name)
    {
        if (isset($this->resources[$name]))
            unset($this->resources[$name]);
    }
    
    /* =========================================================================
     * ~~ Getters and Setters
     * =======================================================================*/
    
    public function getAuth()
    {
        return $this->auth;
    }
    
    public function setAuth($auth)
    {
        $this->auth = $auth;
    }
    
    
    /* =========================================================================
     * ~~ Setup Functions
     * =======================================================================*/
    
    private function setupResources()
    {
        $this->resources['categories'] = new Categories($this);
        $this->resources['developers'] = new Developers($this);
        $this->resources['engines'] = new Engines($this);
        $this->resources['games'] = new Games($this);
        $this->resources['gametypes'] = new GameTypes($this);
        $this->resources['genres'] = new Genres($this);
        $this->resources['guests'] = new Guests($this);
        $this->resources['leaderboards'] = new Leaderboards($this);
        $this->resources['notifications'] = new Notifications($this);
        $this->resources['platforms'] = new Platforms($this);
        $this->resources['profile'] = new Profile($this);
        $this->resources['publishers'] = new Publishers($this);
        $this->resources['regions'] = new Regions($this);
        $this->resources['runs'] = new Runs($this);
        $this->resources['series'] = new Series($this);
        $this->resources['users'] = new Users($this);
        $this->resources['variables'] = new Variables($this);
    }
    
    /* =========================================================================
     * ~~ Request Functions
     * =======================================================================*/
    
    public function sendGet($endpoint, $query = [], $auth = false)
    {
        return $this->doRequest($endpoint, function($content) {
            return array(
                CURLOPT_CUSTOMREQUEST   => 'GET',
            );
        }, $query, null, $auth);
    }
    
    public function sendPostJson($endpoint, $content = null, $query = [], $auth = false)
    {
        return $this->doRequest($endpoint, function($content) {
            $json = json_encode($content);
            if (\json_last_error() != JSON_ERROR_NONE)
                return false;
            
            return array(
                CURLOPT_CUSTOMREQUEST   => 'POST',
                CURLOPT_POSTFIELDS      => $json,
            );
        }, $query, $content, $auth, array(
            'Content-Type'  => 'application/json',
        ));
    }
    
    /* =========================================================================
     * ~~ Private Helper Functions
     * =======================================================================*/
    
    private function doRequest($url, $settings, $query = [], $content = null, $auth = false, $header = [])
    {
        $url = $this->applyQuery($url, $query);
        $header = $this->applyHeader($header, $auth);
        $settings = call_user_func($settings, $content);
        if (!$url || !$header || !$settings)
            return false;
            
        $set = array(
            CURLOPT_FOLLOWLOCATION  => true,
            CURLOPT_FRESH_CONNECT   => true,
            CURLOPT_HEADER          => false,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_HTTPHEADER      => $header,
        );
        foreach ($set as $opt => $val) {
            $settings[$opt] = $val;
        }
        
        var_dump($url);
        
        $curl = curl_init($url);
        curl_setopt_array($curl, $settings);
        $response = curl_exec($curl);
        $error = curl_errno($curl);
        curl_close($curl);
        
        var_dump($error);
        var_dump($response);
        
        if ($error > 0)
            return false;
        
        return $this->handleResponse($response);
    }
    
    private function applyQuery($url, $query)
    {
        $url = $this->removeQuery($this->baseUrl . $url);
        if (!$url)
            return false;
        
        return $url . '?' . http_build_query($query);
    }
    
    private function removeQuery($url)
    {
        $content = parse_url($url);
        if ($content === false)
            return false;
        
        $build = '';
        if (isset($content['scheme']))
            $build .= $content['scheme'] . '://';
        
        if (isset($content['user'])) {
            $build .= $content['user'];
            if (isset($content['pass']))
                $build .= ':' . $content['pass'];
            
            $build .= '@';
        }
        
        if (isset($content['host']))
            $build .= $content['host'];
        
        if (isset($content['port']))
            $build .= ':' . $content['port'];
        
        if (isset($content['path']))
            $build .= $content['path'];
        
        return $build;
    }
    
    private function applyHeader($header, $auth = false)
    {
        if ($auth && !isset($this->auth))
            return false;
        
        $default = array(
            'Accept'    => 'application/json',
        );
        
        if ($auth)
            $default['X-API-Key'] = $this->auth;
        
        $header = array_merge($header, $default);
        
        $build = array();
        foreach ($header as $key => $val) {
            $build[] = $key . ': ' . $val;
        }
        return $build;
    }
    
    private function handleResponse($response)
    {
        if (empty($response) || is_null($response))
            return null;
        
        $json = \json_decode($response);
        if (\json_last_error() != JSON_ERROR_NONE)
            return false;
        
        if (isset($json->status) && $json->status >= 400)
            return false;
        
        return $json;
    }
}

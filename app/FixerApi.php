<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\App;

class FixerApi
{

    private $client;
    private $access_key;
    private $symbols;

    public function __construct()
    {
        // Use Guzzle HTTP to make API request
        // Config variables set in config/fixer.php
        $this->client = new Client(['base_uri' => Config::get('fixer.base_uri')]);
        $this->access_key = Config::get('fixer.access_key');
        $this->symbols = Config::get('fixer.symbols');
    }

    public function request($method, $uri){

        $response = $this->client->request($method, $uri, [
            'query' => [
                'access_key' => $this->access_key,
                'symbols' => $this->symbols
            ]
        ]);

        $code = $response->getStatusCode();

        // Redirect to error page if not a 200
        if($code != 200){
            return $this->handle_error($code);
        }

        $results = json_decode($response->getBody());

        if($results->success == false){
            return $this->handle_error($results->error->code);
        }

        return $results;
    }

    public function handle_error($code = 404)
    {
        return abort($code);
    }


}

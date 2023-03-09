<?php

namespace Jeff\Amadeus;

use Illuminate\Support\Facades\Config;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Amadeus {

    protected $client_id;

	protected $client_secret;

	protected $grant_type;

	protected $sandbox;

	protected $test_link;

	protected $live_link;

	protected $timeout;

	protected $RETURNTRANSFER;

    protected $token = null;

    public function __construct()
    {
        $this->client_id      	= Config::get('amadeus', 'client_id');
		$this->client_secret    = Config::get('amadeus', 'client_secret');
		$this->grant_type    	= Config::get('amadeus', 'grant_type');
	 	$this->sandbox 			= Config::get('amadeus', 'sandbox');
	 	$this->test_link    	= Config::get('amadeus', 'test_link');
	 	$this->live_link     	= Config::get('amadeus', 'live_link');
	 	$this->timeout     		= Config::get('amadeus', 'timeout');
		$this->RETURNTRANSFER   = Config::get('amadeus', 'RETURNTRANSFER');
		
        $this->base_url = $this->live_link;

    }

    public function greet()
    {
        return 'Hi test ! How are you doing today?';
    }

    
    public function url()
    {
        if($this->sandbox) {
            $this->base_url = $this->test_link;
        }

        return $this->base_url;
    }

    public function getAccessToken()
    {
        self::createAccessToken();
    }

    public function createAccessToken()
    {
        $url = self::url() . "v1/security/oauth2/token";

        try {
            $client = new Client();
            $result = $client->post($url, [
                'form_params' => [ 
                    'client_id' => $this->client_id,
                    'client_secret' => $this->client_secret,
                    'grant_type' =>  $this->grant_type,
                ]
            ]);

            if ($result->getStatusCode()) {
                $result = json_decode($result->getBody());

                if(isset($result->access_token)){
                    $this->token = $result->access_token;
                    return true;
                }
            }

        } catch (GuzzleException $e) {
            return false;
        }

        return false;
    }
}

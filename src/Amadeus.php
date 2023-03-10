<?php

namespace Jeff\Amadeus;

use Illuminate\Support\Facades\Config;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Amadeus {

    protected $clientId;

	protected $clientSecret;

	protected $grantType;

	protected $sandbox;

	protected $testLink;

	protected $liveLink;

	protected $timeout;

	protected $returnTransfer;

    protected $token = null;

    public function __construct()
    {
        $this->setClientID(config('amadeus.client_id'));
        $this->setClientSecret(config('amadeus.client_secret'));
        $this->setGrantType(config('amadeus.client_secret'));
        $this->setSandbox(config('amadeus.sandbox'));
        $this->setTestLink(config('amadeus.test_link'));
        $this->setLiveLink(config('amadeus.live_link'));
        $this->setTimeout(config('amadeus.timeout'));
        $this->setReturnTransfer(config('amadeus.RETURNTRANSFER'));
    }

    public function setClientID($clientId)
    {
        $this->clientID = $clientId;
    }

    public function getClientID()
    {
        return $this->clientID;
    }

    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    public function setGrantType($grantType)
    {
        $this->grantType = $grantType;
    }

    public function getGrantType()
    {
        return $this->grantType;
    }

    public function setSandbox($sandbox)
    {
        $this->sandbox = $sandbox;
    }

    public function getSandbox()
    {
        return $this->sandbox;
    }

    public function setTestLink($testLink)
    {
        $this->testLink = $testLink;
    }

    public function getTestLink()
    {
        return $this->testLink;
    }

    public function setLiveLink($liveLink)
    {
        $this->liveLink = $liveLink;
    }

    public function getLiveLink()
    {
        return $this->liveLink;
    }

    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    public function getTimeout()
    {
        return $this->timeout;
    }

    public function setReturnTransfer($returnTransfer){
        $this->returnTransfer = $returnTransfer;
    }

    public function getReturnTransfer()
    {
        return $this->returnTransfer;
    }

    public function url()
    {
        $baseUrl = $this->liveLink;
        if ($this->returnTransfer) {
            $baseUrl = $this->testLink;
        }

        return $baseUrl;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function createAccessToken()
    {
        $url = self::url()."v1/security/oauth2/token";

        try {
            $client = new Client();

            $result = $client->post($url, [
                'form_params' => [
                    'client_id' => $this->clientID,
                    'client_secret' => $this->clientSecret, 
                    'grant_type' =>  $this->grantType,
                ]
            ]);
            return $result;
            if ($result->getStatusCode()) {
                $result = json_decode($result->getBody());

                if(isset($result->access_token)){
                    return $result->access_token;
                }
            } else {
                return false;
            }
        } catch (GuzzleException $e) {
            return false;
        }
    }
}

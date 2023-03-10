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
        $this->setClientID(Config::get('amadeus', 'client_id'));
        $this->setClientSecret(Config::get('amadeus', 'client_secret'));
        $this->setGrantType(Config::get('amadeus', 'client_secret'));
        $this->setSandbox(Config::get('amadeus', 'sandbox'));
        $this->setTestLink(Config::get('amadeus', 'test_link'));
        $this->setLiveLink(Config::get('amadeus', 'live_link'));
        $this->setTimeout(Config::get('amadeus', 'timeout'));
        $this->setReturnTransfer(Config::get('amadeus', 'RETURNTRANSFER'));
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

}

<?php

namespace Jeff\Amadeus;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class Token {

    public function createAccessToken()
    {
        $amadeus = new Amadeus;

        $url = $amadeus->url()."v1/security/oauth2/token";

        try {
            $client = new Client();

            $result = $client->post($url, [
                'form_params' => [
                    'client_id' => $amadeus->getClientID(),
                    'client_secret' => $amadeus->getClientSecret(),
                    'grant_type' =>  $amadeus->getGrantType(),
                ]
            ]);

            if ($result->getStatusCode()) {
                $result = json_decode($result->getBody());

                if(isset($result->access_token)){
                    $amadeus->setToken($result->access_token);
                    return true;
                }
            } else {
                return false;
            }
        } catch (GuzzleException $e) {
            return false;
        }
    }
}
<?php

namespace GeoNames\Manager;

use GuzzleHttp\Client;

class GeoNames
{
    const COUNTRY = 3469034;

    private $client;

    private $url = 'http://www.geonames.org/childrenJSON?geonameId=';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getStates(){
        $url = $this->url . self::COUNTRY;
        $response = $this->client->get($url);

        if($response->getStatusCode() == 200){
            return json_decode($response->getBody()->getContents());
        }
        return false;
    }

    public function getCities($stateId){

        $url = $this->url . $stateId;
        $response = $this->client->get($url);

        if($response->getStatusCode() == 200){
            return json_decode($response->getBody()->getContents());
        }
        return false;
    }

    public function getStatesWithCities(){
        $states = $this->getStates()->geonames;
        foreach ($states as $state){
            var_dump($states);die;
        }
    }

}
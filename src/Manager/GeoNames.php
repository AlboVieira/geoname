<?php

namespace GeoNames\Manager;

use GuzzleHttp\Client;

class GeoNames
{
    const COUNTRY = 3469034;

    private $url = 'http://www.geonames.org/childrenJSON?geonameId=';

    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getStates(){
        $url = $this->url . self::COUNTRY;
        $response = $this->client->get($url);

        if($response->getStatusCode() == 200){
            return json_decode($response->getBody()->getContents(),true);
        }
        return false;
    }

    public function getCities($stateId){

        $url = $this->url . $stateId;
        $response = $this->client->get($url);

        if($response->getStatusCode() == 200){
            return json_decode($response->getBody()->getContents(),true);
        }
        return false;
    }

    public function getStatesWithCities(){

        $states = $this->getStates()['geonames'];
        foreach ($states as $key => $state){
            $state['cities'] = $this->getCities($state['geonameId']);
            $states[$key] = $state;
        }
        return $states;
    }

    public function toJson($array){
        return json_encode($array,JSON_UNESCAPED_UNICODE );
    }
}
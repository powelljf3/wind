<?php

namespace App\Http\Controllers;

use App\WindData;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WindDataController extends Controller
{
    /**
     * Return the wind data
     *
     * @return \Illuminate\Http\Response
     */
    public function index($zip)
    {
        if(strlen($zip) != 5) {
            return "{'error':'404'}";
        }
        $client = null;
        if(!$client) {
            $windData = new WindData;
            $client = new Client(['base_uri' => 'http://api.openweathermap.org/data/2.5']);
        }
        if (time() - $windData->previousRead > 900) {
            $response = $client->request('GET', 'weather?zip='.$zip.',us&appid=dbb475e7958ed72a954485d311713934');
            $responseArray = json_decode($response);
            $winData->previousRead = time();
            $winData->speed = $responseArray['wind']['speed'];
            $winData->direction = $responseArray['wind']['deg'];
            return json_encode($windData);  
        }
    }
}

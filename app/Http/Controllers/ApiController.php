<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    public function getQuote()
    {
        $chuckNorrisQuote = $this->getChuckNorrisQuote();


        $catFact = $this->getCatFact();

        $data = [
            'quote' => $chuckNorrisQuote,
            'status' => 'success',
            'source' => 'Chuck Norris Jokes API',
            'cat_fact' => $catFact,
        ];

        return response()->json($data);
    }

    private function getChuckNorrisQuote()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.chucknorris.io/jokes/random');
        $data = json_decode($response->getBody());

        return $data->value;
    }

    private function getCatFact()
    {
        $response = file_get_contents('https://catfact.ninja/fact');
        $data = json_decode($response);

        return $data->fact;
    }
}


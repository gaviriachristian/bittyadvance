<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

use Illuminate\Routing\Controller as BaseController;

class ProjectController extends BaseController
{
    public function index()
    {
        $client = new Client();
        $url = "https://api.finicity.com/aggregation/v2/partners/authentication";

        $params = [
            "partnerId" => "2445583422529",
            "partnerSecret" => "p7LIUPE1lL69Bebmlm0y"
        ];

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Finicity-App-Key' => '02e7fdac60091444a8e4e881cd0e7e50',
            'api-key' => 'k3Hy5qr73QhXrmHLXhpEh6CQ'
        ];

        $response = $client->request('POST', $url, [
            'json' => $params,
            'headers' => $headers,
            'verify'  => false,
        ]);

        $responseBody = json_decode($response->getBody());
        var_dump($responseBody);

        //return view('projects.apiwithkey', compact('responseBody'));
    }

}

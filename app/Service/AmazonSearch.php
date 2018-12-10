<?php

namespace App\Service;

use App\Suggest;
use GuzzleHttp\Client;

class AmazonSearch implements Search
{
    protected $url = 'http://completion.amazon.com';

    public function run($output)
    {
        for ($i = 'AA'; $i != 'AAA'; $i++) {
            $client = new Client([
                'base_uri' => $this->url,
                'timeout' => 4.0
            ]);

            $response = $client->request('GET', '/search/complete', [
                'query' => [
                    'q'            => $i,
                    'search-alias' => 'aps',
                    'client'       => 'amazon-search-ui',
                    'mkt'          => '1'
                ]
            ]);

            $data = json_decode((string)$response->getBody())[1];

            for ($x = 0; $x < count($data); $x++) {
                Suggest::create([
                    'keywords' => $data[$x]
                ]);
            }

            $output->progressAdvance();
        }
    }
}

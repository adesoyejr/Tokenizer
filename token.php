<?php
    require_once ('connection.php');
    require_once './vendor/autoload.php';

    use GuzzleHttp\Client;
    use GuzzleHttp\Subscriber\Oauth\Oauth1;

    // var_dump($client = new GuzzleHttp\Client());

    // die('');
 
    $client = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'https://reqres.in',
    ]);
    
    $response = $client->request('POST', '/api/users', [
        'json' => [
            'name' => 'Sam',
            'job' => 'Developer'
        ]
    ]);
    
    //get status code using $response->getStatusCode();
    
    $body = $response->getBody();
    $arr_body = json_decode($body);
    print_r($arr_body);
?>
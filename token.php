<?php
    require_once 'controller.php';
    require_once './vendor/autoload.php';

    use GuzzleHttp\Client;
    

    class tokenize{

        public function getToken($AccountNumber, $BVNNumber){
           
            $client = new Client([
        
                'base_uri' => 'https://192.168.21.216:8643',
                'verify' => false
            ]);
            // $identifier = $AccountNumber;
            // $inputData = $BVNNumber;
        
            $json = "{\n    \"policyName\": \"apirand\",\n    \"dataList\": {\n        \"dataItem\": [\n            {\n                \"identifier\": \"$AccountNumber\",\n                \"inputData\": \"$BVNNumber\"\n            }\n        ]\n    }\n}";
            $json1 = json_decode($json);
        
           // var_dump($json1);
            $response = $client->request('POST', '/DpmTokenManagerCoreEngine/tokenmanagerRestful/doTokenization',
            [
             //   'debug' => true,
                'headers' => [
                    // 'User-Agent' => 'testing/1.0',
                    'username' => 'test',
                    'created' => '2021-10-08T20:42:27.304Z',
                    'nonce' => 'VjpbRCorJDwrIUsrI3l8ew==',
                    'password' => 'ZMO8NvnPH0sRqf8IBkfacJD+kEWzh6nZYT4Iz7ha+n4=',
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                    // 'Connection' => 'keep-alive',
                    // 'Accept-Encoding' => ['gzip', 'deflate', 'br']
                ],
                'json' =>  $json1
               
            ]
        );
            
            //get status code using $response->getStatusCode();
            
            //$code = $response->getStatusCode();
            // var_dump($code);
            // to get json 
            //var_dump($response->getBody()->getContents());
            //$token = $response->getBody()->getContents()
        
            $body = $response->getBody()->getContents();
            $arr_body = json_decode($body);
            $token_arr = $arr_body->responseDetails;
            $token = $token_arr[0]->token;
            return $token;
            // var_dump($token);
        
            // print_r($arr_body);

        }

    

    }
     
    
?>
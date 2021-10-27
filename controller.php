<?php

    require_once("connection.php");
    require_once './vendor/autoload.php';

    use GuzzleHttp\Client;

    class tokenize{

        public function getToken($AccountNumber, $BVNNumber){
           
            $client = new Client([
        
                'base_uri' => 'https://192.168.21.216:8643',
                'verify' => false
            ]);
        
            $json = "{\n    \"policyName\": \"apirand2\",\n    \"dataList\": {\n        \"dataItem\": [\n            {\n                \"identifier\": \"$AccountNumber\",\n                \"inputData\": \"$BVNNumber\"\n            }\n        ]\n    }\n}";
            $json1 = json_decode($json);
        
            $response = $client->request('POST', '/DpmTokenManagerCoreEngine/tokenmanagerRestful/doTokenization',
            [
                'headers' => [
                    'username' => 'test',
                    'created' => '2021-10-08T20:42:27.304Z',
                    'nonce' => 'VjpbRCorJDwrIUsrI3l8ew==',
                    'password' => 'ZMO8NvnPH0sRqf8IBkfacJD+kEWzh6nZYT4Iz7ha+n4=',
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                    
                ],
                'json' =>  $json1
            ]
        );                  
            $body = $response->getBody()->getContents();
            $arr_body = json_decode($body);
            $token_arr = $arr_body->responseDetails;
            $token = $token_arr[0]->token;
            return $token;
        }

        public function deToken($AccountNumber, $thisToken){
           
            $client = new Client([
        
                'base_uri' => 'https://192.168.21.216:8643',
                'verify' => false
            ]);
        
            $json = "{\n    \"policyName\": \"apirand2\",\n    \"dataList\": {\n        \"dataItem\": [\n            {\n                \"identifier\": \"$AccountNumber\",\n                \"token\": \"$thisToken\"\n            }\n        ]\n    }\n}";
            $json1 = json_decode($json);
        
            $response = $client->request('POST', '/DpmTokenManagerCoreEngine/tokenmanagerRestful/doDetokenization',
            [
                'headers' => [
                    'username' => 'test',
                    'created' => '2021-10-08T20:42:27.304Z',
                    'nonce' => 'VjpbRCorJDwrIUsrI3l8ew==',
                    'password' => 'ZMO8NvnPH0sRqf8IBkfacJD+kEWzh6nZYT4Iz7ha+n4=',
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                    
                ],
                'json' =>  $json1
            ]
        );                  
            $body = $response->getBody()->getContents();
            $arr_body = json_decode($body);
            $bvn_arr = $arr_body->responseDetails;
            $bvn = $bvn_arr[0]->originalValue;
            return $bvn;
        }
    }
    
    class user{
        protected $connection;
      
        public function __construct($connection){
          $this->connection = $connection;  
      
        }
        public function create($username, $password, $type, $question, $answer){
      
          $hash = password_hash($password, PASSWORD_DEFAULT);
          
          $sql = "INSERT INTO `users` (`username`, `password`, `type`, `question`, `answer`) VALUES ('$username', '$hash', $type, '$question', '$answer')";
      
          $result = mysqli_query($this->connection, $sql);
      
          if($result)
          {
            return TRUE;
          }else
          {
            return FALSE;
          }
        }

        public function changePassword($username, $password, $oldpassword, $newpassword){

          $hash = password_hash($newpassword, PASSWORD_DEFAULT);

          if(password_verify($oldpassword, $password)){
            if($oldpassword != $newpassword){

                $sql = "UPDATE `users` set password='$hash' where username='$username'";
                $result = mysqli_query($this->connection, $sql);

                if($result)
                {
                    return TRUE;
                }else
                {
                    return FALSE;
                }
            }else
            {
                echo "
                <div class='col-lg-12'>
                    <div class='animated shake' style='background-color:darkred; padding: 10px 0'>
                    <center><h5 style='color:white'>New Password cannot be old password!</h5></center>
                    </div>
                </div>
                ";
            }
          }else{
            echo "
            <div class='col-lg-12'>
                <div class='animated shake' style='background-color:darkred; padding: 10px 0'>
                <center><h5 style='color:white'>Password Incorrect!</h5></center>
                </div>
            </div>
            ";
          }  
        }
        
    }

    class account{
        protected $connection;

        public function __construct($connection){
            $this->connection = $connection;
        }
        
        public function create($FirstName, $LastName, $AccountNumber, $BVNNumber, $EmailAddress, $BankBranch, $HomeAddress, $TelephoneNumber, $AccountType, $Balance, $logon, $CreditCard, $imgContent){

            // $fortoken = new tokenize();
            // $BVNToken = $fortoken->getToken($AccountNumber, $BVNNumber);
            // $CreditToken = $fortoken->getToken($AccountNumber, $CreditCard);
            // $BalanceToken = $fortoken->getToken($AccountNumber, $Balance);

            $sql = "INSERT INTO `staffdata` (`FirstName`, `LastName`, `AccountNumber`, `BVNNumber`, `EmailAddress`, `BankBranch`, `HomeAddress`, `TelephoneNumber`, `AccountType`, `Balance`, `logon`, `CreditCard`, `dp`) VALUES ('$FirstName', '$LastName', '$AccountNumber', '$BVNNumber', '$EmailAddress', '$BankBranch', '$HomeAddress', '$TelephoneNumber', '$AccountType', '$Balance', '$logon', '$CreditCard', '$imgContent')";
    
            $result = mysqli_query($this->connection, $sql);

            if($result)
            {
                return TRUE;
            }else
            {
                return FALSE;
            }
        }

        public function doDeposit($AccountNumber, $Amount, $Depositor, $Balance){
            $sql =  "INSERT INTO `transactions` (`AccountNumber`, `amount`, `transtype`, `personnel`, `transtime`) VALUES ('$AccountNumber', '$Amount', 'Credit', '$Depositor', now())";
        
            $result = mysqli_query($this->connection, $sql);

            if($result)
            {
                $Balance += $Amount; 
                $sql = "UPDATE `staffdata` set Balance='$Balance' where AccountNumber='$AccountNumber'";
                $result = mysqli_query($this->connection, $sql);
                if($result){
                    return TRUE; 
                }
                else{
                    return FALSE;   
                } 
            }else
            {
                return FALSE;
            }
        }

        public function doWithdrawal($AccountNumber, $Amount, $Withdrawer, $Balance){
            if($Balance >= $Amount){
                $sql =  "INSERT INTO `transactions` (`AccountNumber`, `amount`, `transtype`, `personnel`, `transtime`) VALUES ('$AccountNumber', '$Amount', 'Debit', '$Withdrawer', now())";
            
                $result = mysqli_query($this->connection, $sql);

                if($result)
                {
                    $Balance -=  $Amount; 
                    $sql = "UPDATE `staffdata` set Balance='$Balance' where AccountNumber='$AccountNumber'";
                    $result = mysqli_query($this->connection, $sql);
                    if($result){
                        return TRUE; 
                    }
                    else{
                        return FALSE;   
                    } 
                }else
                {
                    return FALSE;
                }
            }else
            {
                return FALSE;
            }
        }   
    }

       
?>
<?php

    require_once("connection.php");

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
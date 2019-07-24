<?php

/**
 * insert,select like all database actions is here
 */

include_once('./classes/Database.php');

class UserModel {  
    function __construct()
    {
        $dbObj = new Database;
        $this->connection = $dbObj->connect(); 
    }
    
    /**
     * checkExisitingUser
     * checking if any user exist with the posted email
     * @param string $email
     * @return boolean 
     */ 
    function checkExisitingUser(string $email) : bool 
    {
    	$sql = "SELECT id FROM users where email = '".$email."'";
        $result = mysqli_query($this->connection, $sql);

        return mysqli_num_rows($result) == 0;  
    }

    /** 
     * postRegister 
     * post registration datas to database
     * @param array $data
     * @return boolean 
     */
    function postRegister(array $data) : bool 
    {
        $encryptedPwd = $this->encodePassword($data['password']);
        $created_at = date("Y-m-d H:i:s");
        $sql = "INSERT INTO users(first_name, last_name, email, password, dob, created_at)VALUES ('".$data['first_name']."', '".$data['last_name']."', '".$data['email']."', '".$encryptedPwd."', '".$data['dob']."', '".$created_at."')";
        $response = [];
        
        if (mysqli_query($this->connection, $sql)) {
            Session::setSessionUser($this->connection->insert_id);

            return true;

        } else {

        	$errorMsg = "Error: " . $sql . "" . mysqli_error($this->connection);
            Session::setErrorMesssage($errorMsg);

            return false;  
        }
       
    }
    
    /**
     * encodePassword
     * encoding password
     * @param string $password
     * @return string
     */ 
    private function encodePassword(string $password) : string 
    {
        return md5($password); 
    }

    /** 
     * getUser
     * get users list
     * @return array
     */
    function getUser() : array {
        $users = [];
        $sql = "SELECT id, first_name, last_name, email, dob FROM users";
        $result = mysqli_query($this->connection, $sql);
        $i = 0;

        while($row = mysqli_fetch_assoc($result)) {
            $users[$i] = $row;
            $users[$i]['dob']=date("d-m-Y", strtotime($row['dob']));
            $i++;
        }

        return $users;
    }
    
    /**
     * postLoginUser 
     * ckeck login datas with db
     * @param array $data
     * @return boolean
     */ 
    function postLoginUser(array $data) : bool 
    {
        $encryptedPwd = $this->encodePassword($data['password']);
        $sql = "SELECT id FROM users WHERE email = '".$data['email']."' AND password = '".$encryptedPwd."'";
        $result = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($result) > 0) { 

            while($row = mysqli_fetch_assoc($result)) {
                Session::setSessionUser($row['id']);
            }

            return true;

         } else if(mysqli_num_rows($result) == 0) {
            $errorMsg = 'Invalid user';
            Session::setErrorMesssage($errorMsg);

            return false;

        } else { 
            $errorMsg = "Error: " . $sql . "" . mysqli_error($this->connection);
            Session::setErrorMesssage($errorMsg);

            return false;  
        }
    }
   
}
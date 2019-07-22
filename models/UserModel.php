<?php

/**
 * insert,select like all database actions is here
 */

class UserModel extends Database {  
    function __construct()
    {
       $this->connection = $this->connect(); 
    }
    
    /**
     * checkExisitingUser
     * checking if any user exist with the posted email
     * @return boolean 
     */ 
    function checkExisitingUser() : bool 
    {
    	$sql = "SELECT id FROM users where email='".$_POST['email']."'";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) == 0) {  
           return true;  
        } else {  
            return false;  
        } 
    }

    /** 
     * postRegister 
     * post registration datas to database
     * @return boolean 
     */
    function postRegister() : bool 
    {
        $encryptedPwd = $this->encodePassword($_POST['password']);
        $created_at = date("Y-m-d H:i:s");
        $sql = "INSERT INTO users(first_name,last_name,email,password,dob,created_at)VALUES ('".$_POST['first_name']."','".$_POST['last_name']."','".$_POST['email']."','".$encryptedPwd."','".$_POST['dob']."','".$created_at."')";
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
    private function encodePassword($password) : string 
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
        $sql = "SELECT id,first_name,last_name,email,dob FROM users";
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
     * @return boolean
     */ 
    function postLoginUser() : bool 
    {
        $encryptedPwd = $this->encodePassword($_POST['password']);
        $sql = "SELECT id FROM users WHERE email = '".$_POST['email']."' AND password = '".$encryptedPwd."'";
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
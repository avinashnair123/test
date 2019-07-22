<?php
//insert,select like all database actions is here
class UserModel extends Database {  
    function __construct()
    {
       $this->connection = $this->connect(); 
    }
    
    /* checking if any user exist with the posted email
       posted email as param
       return true if no user exist with the posted email */ 
    function checkExisitingUser() {
    	$sql = "SELECT id FROM users where email='".$_POST['email']."'";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) == 0) {  
           return true;  
        } else {  
            return false;  
        } 
    }

    /* post registration datas to database
       return true after posted successfully
       save user data to session  */
    function postRegister() {
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
    
    /* encoding password
      param : password(string)
      returns encoded password(string) */
    private function encodePassword($password) {
        return md5($password); 
    }

    /* get users list
       return users list(array) */
    function getUser() {
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
    
    /* ckeck login datas with db
       return true if username and password matching
       save user data to session */
    function postLoginUser() {
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
<?php

/** 
 * connection to the database
 */

class Database  
{  
    function __construct() {  
    } 
    
    public $host = 'localhost';
    public $username = 'root';
    public $password = '';
    public $dbName = 'test_avi';
    public $db; 
    
    /** 
     * connect
     * Connect with the database
     */
    function connect()
    {
        if (!isset($db)) {
            $db = mysqli_connect($this->host , $this->username, $this->password, $this->dbName);
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error(); die;
            } 
        }
        return $db; 
    }
    
}
?>
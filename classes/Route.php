<?php

/** 
 *declaring all routes and redirections
*/

class Route {
    
    /**  
      * constructor
      */ 
    function __construct($userController) {
        $this->userControllerObj = $userController;     
    }

    /**  
      * getRedirect
      * redirecting depends on the url
      */   
    function getRedirect() {
        $requestUri = $_SERVER['REQUEST_URI'];
        $urlValues = explode("/", $requestUri);
        $url = end($urlValues);
        $method = $_SERVER['REQUEST_METHOD']; 
        
        if($url) {

            switch ($url) {

                case "index.php":
                case "users":

                    $this->userControllerObj->getIndex();
                    break;

                case "register":

                    if($method=='GET') 

                        $this->userControllerObj->getView('register');

                    else if($method=='POST')

                        $this->userControllerObj->postRegister();

                    break;

                case "home":

                    $this->userControllerObj->getHome();
                    break;

                case "logout":

                    $this->userControllerObj->getLogout();
                    break;

                case "login":

                    if($method=='GET')

                        $this->userControllerObj->getView('login');

                    else if($method=='POST') 

                        $this->userControllerObj->postLogin();

                    break; 

                default:

                    header('Location: users');     
            }

        } else {

            $this->userControllerObj->getIndex();
            
        } 
    }        
} 
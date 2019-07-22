<?php
//declaring all routes and redirections
class Route {
    function __construct() {
        $this->userControllerObj = new UserController;     
    }
    
    //redirecting depends on the url 
    function getRedirect() {
        $requestUri = $_SERVER['REQUEST_URI'];
        $urlValues = explode("/",$requestUri);
        $url = end($urlValues);
        $method = $_SERVER['REQUEST_METHOD'];
        
        if($url) {
            switch ($url) {
                case "register":
                    if($method=='GET') {
                        $this->userControllerObj->getView('register');
                    } else if($method=='POST') {
                                
                    }
                    break;
            }
        } 
    }        
} 
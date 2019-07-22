<?php
// all actions for register,login and listing is here
class UserController { 
    function __construct()
    {
         
    }
    
    /* to redirect to view pages
       view name as parameter */   
    function getView($view) {
        require_once('./views/'.$view.'.php');
    }
} 
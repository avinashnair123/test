<?php

/*  base file
    */
    
    error_reporting(0);
	require_once('autoload.php');
    
    $routeObj = new Route(new UserController(new UserModel)); 
	$routeObj->getRedirect(); 
	
?> 
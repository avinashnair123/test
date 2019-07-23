<?php
//  base file 
    
    /*  Development */
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
    
    /* production */
    error_reporting(0);
	
	require_once('autoload.php');
    
    $routeObj = new Route(new UserController(new UserModel)); 
	$routeObj->getRedirect(); 
	
?> 
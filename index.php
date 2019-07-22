<?php
//  base file 
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	require_once('autoload.php');
    
    $routeObj = new Route; 
	$routeObj->getRedirect();
	
?> 
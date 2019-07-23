<?php
    
    /**
     * auto loading classes
     */ 
	
	spl_autoload_register(function ($class_name) {
	    $modelPath = './models/'.$class_name.'.php';
	    $controllersPath = './controllers/'.$class_name.'.php';
	    $classPath = './classes/'.$class_name.'.php';
	    
	    if(file_exists($modelPath)){
	        require_once($modelPath);
	    } else if(file_exists($controllersPath)){
	        require_once($controllersPath);
	    } else if(file_exists($classPath)){
	    	require_once($classPath);
		}
		
	}); 
?> 
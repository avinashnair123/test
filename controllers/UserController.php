<?php
// all actions for register,login and listing is here
class UserController { 
    function __construct()
    {
        $this->userModelObj = new UserModel;     
    }

    static $userList = [];
    
    /* to redirect to view pages
       view name as parameter */   
    function getView($view) {
        session_start();
        $isLogged = Session::checkisLogged();
        if($isLogged) {
            header('Location: home');
        } else {   
            require_once('./views/'.$view.'.php');
        }
    }

    /* save posted data to db
       params : post data from the register form */
    function postRegister() {
        $validation = $this->validationCheck();
    	if($validation) {
            session_start();
            Session::setErrorMesssage('All fields are required');
    	    $this->getView('register');
    	} else {
            $checkUserNotExist = $this->userModelObj->checkExisitingUser();
    		if($checkUserNotExist) {
    			$registerUser = $this->userModelObj->postRegister();
    			if($registerUser) {
                    header('Location: home');
    			} else {
                    $this->getView('register');
    			}
    	    } else {
                session_start();
    	    	Session::setErrorMesssage('Email alredy exists');
    	    	$this->getView('register');
    	    }		
    	}
    	
    }

    /* validating the post data
       return true when a validation error exist */
    private function validationCheck() {
        $validationExist = false;
        foreach($_POST as $val) {
            if ($val=='') {
               $validationExist = true;
            }
        }
        if($validationExist) {
           return true;  
        } else {
           return false;
        } 
    }

    /* redirection to the home page after login/registration */
    function getHome() {
        session_start();
        $isLogged = Session::checkisLogged();
        if($isLogged) {
            require_once('./views/home.php');
        } else {    
            header('Location: users');
        }  
        
    }

    /* logout function */
    function getLogout() {
        Session::clearSessionUser();
        header('Location: users');
    }
    
    /* redirect to index page */
    function getIndex() {
        session_start();
        $isLogged = Session::checkisLogged();
        if($isLogged) {
            header('Location: home');
        } else {    
            self::$userList = $this->userModelObj->getUser();
            require_once('./views/index.php'); 
        }
    }
} 
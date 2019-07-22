<?php
// all actions for register,login and listing is here
class UserController { 
    function __construct()
    {
        $this->userModelObj = new UserModel;     
    }

    static $userList = [];
    static $csrftoken = '';
    
    /* to redirect to view pages
       view name as parameter */   
    function getView($view) {
        session_start();
        self::$csrftoken = Session::setCsrfToken();
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
        $this->checkToken();
        $validation = $this->validationCheck();
    	if($validation) {
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
    
    /* login  ckeck function
       params : post data from the login form */
    function postLogin() {
        $this->checkToken();
        $validation = $this->validationCheck();
        if($validation) {
            Session::setErrorMesssage('all fields are required');
    	    $this->getView('login');
        } else {
            $loginUser = $this->userModelObj->postLoginUser();
            if($loginUser) {
              header('Location: home');
            } else {
                $this->getView('login');
            }
        }
        
    }

    /* check posted csrf token with token in the session
       exit if mismatch found */
    private function checkToken() {
        session_start();
        $isTokenMatching = Session::checktokenMatch();
        if(!$isTokenMatching ){
            echo "Token Missmatch"; exit;
        } 
        
    }
} 
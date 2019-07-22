<?php

/** 
 *  all actions for register,login and listing is here
 */

class UserController { 
    function __construct()
    {
        $this->userModelObj = new UserModel;     
    }

    static $userList = [];
    static $csrftoken = '';
    
    /**
     * getview
     * to redirect to view pages
     * @param string $view
     */   
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

    /**
     * postRegister
     * save posted data to db
     */
    function postRegister() {
        $tokenMisMatch = $this->checkToken();
        if($tokenMisMatch) {
            Session::setErrorMesssage('Token Missmatch');
    	    $this->getView('register');
        }
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

    /** 
     * validationcheck
     * validating the post data
     * @return boolean
     */ 
    private function validationCheck() : bool 
    {
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

    /**
     * getHome
     * redirection to the home page after login/registration 
     */
    function getHome() {
        session_start();
        $isLogged = Session::checkisLogged();
        if($isLogged) {
            require_once('./views/home.php');
        } else {    
            header('Location: users');
        }  
        
    }

    /**
     * getLogout
     *  logout function 
     */
    function getLogout() {
        Session::clearSessionUser();
        header('Location: users');
    }
    
    /**
     * getIndex
     *  redirect to index page 
     */
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
    
    /**
     * postLogin
     * login  ckeck function
     */
    function postLogin() {
        $tokenMisMatch = $this->checkToken();
        if($tokenMisMatch) {
            Session::setErrorMesssage('Token Missmatch');
    	    $this->getView('login');
        }
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

    /**
     * checkToken
     * check posted csrf token with token in the session
     * @return boolean
     */
    private function checkToken() : bool 
    {
        session_start();
        $isTokenMatching = Session::checktokenMatch();
        if(!$isTokenMatching ){
            return true; 
        } 
        
    }
} 
<?php

/** 
 *  all actions for register,login and listing is here
 */

class UserController {
    
    /**  
      * constructor
      */  
    function __construct($userModel)
    {
        $this->userModelObj = $userModel;
        session_start();     
    }

    static $userList = [];
    static $csrftoken = '';
    
    /**
     * getview
     * to redirect to view pages
     * @param string $view
     */   
    function getView(string $view) 
    {
        self::$csrftoken = Session::setCsrfToken();
        $isLogged = Session::checkisLogged();

        if($isLogged)

            header('Location: home');

        else

            require_once('./views/'.$view.'.php');
    }

    /**
     * postRegister
     * save posted data to db
     */
    function postRegister() {
        $postData = $_POST;
        $tokenMisMatch = $this->checkToken($postData['csrf_token']);

        if(!$tokenMisMatch) {

            Session::setErrorMesssage('Token Missmatch');
            $this->getView('register');
            
        } else {

            $validation = $this->validationCheck($postData);

            if($validation) {

                Session::setErrorMesssage('All fields are required');
                $this->getView('register');
                
            } else {

                $checkUserNotExist = $this->userModelObj->checkExisitingUser($postData['email']);

                if($checkUserNotExist) {

                    $registerUser = $this->userModelObj->postRegister($postData);
                    
                    if($registerUser)
                    
                        header('Location: home');

                    else
                    
                        $this->getView('register');

                } else {

                    Session::setErrorMesssage('Email alredy exists');
                    $this->getView('register');
                    
                }		
            }

        }    
    	
    }

    /** 
     * validationcheck
     * validating the post data
     * @param array $data
     * @return boolean
     */ 
    private function validationCheck(array $data) : bool 
    {
        $validationExist = false;

        foreach($data as $val) {

            if ($val=='')

               $validationExist = true;
            
        }

        return $validationExist;  
    }

    /**
     * getHome
     * redirection to the home page after login/registration 
     */
    function getHome() {
        $isLogged = Session::checkisLogged();

        if($isLogged)

            require_once('./views/home.php');

        else

            header('Location: users');

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
        $isLogged = Session::checkisLogged();

        if($isLogged)

            header('Location: home');

        else { 

            self::$userList = $this->userModelObj->getUser();
            require_once('./views/index.php');

        }
    }
    
    /**
     * postLogin
     * login  ckeck function
     */
    function postLogin() {
        $postData = $_POST;
        $tokenMisMatch = $this->checkToken($postData['csrf_token']);
        
        if(!$tokenMisMatch) {
            Session::setErrorMesssage('Token Missmatch');
            $this->getView('login');
            
        } else {
            $validation = $this->validationCheck($postData);

            if($validation) {

                Session::setErrorMesssage('all fields are required');
                $this->getView('login');
                
            } else {

                $loginUser = $this->userModelObj->postLoginUser($postData);

                if($loginUser)

                header('Location: home');

                else 

                $this->getView('login');
            
            }
        }    
        
    }

    /**
     * checkToken
     * check posted csrf token with token in the session
     * @param string $token
     * @return boolean
     */
    private function checkToken(string $token) : bool  
    {
        return Session::checktokenMatch($token);
    }
} 
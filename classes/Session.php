<?php

/** 
 * all actions related to session is here
 */

class Session { 
   
    /** 
     * setSessionUser
     * set current user to session
     */
    static function setSessionUser(int $id) {
        $_SESSION['userId'] = $id;
        $_SESSION['errorMsg'] = ''; 
        
    }

    /**
     * setErrorMesssage
     * set error message to session
     * @param string $message
     */
    static function setErrorMesssage(string $message) {
        $_SESSION['errorMsg'] = $message;  
    }

    /**
     *  clearSessionUser
     *  clear datas from session
     */ 
    static function clearSessionUser() {
        session_destroy();
    }
    
    /**
     *  checkisLogged  
     *  check user is logged in or not 
     * @return boolean
     */  
    static function checkisLogged() : bool 
    {
        return isset($_SESSION['userId']);
    } 
    
    /** 
     * setCsrfToken 
     * set csrf token in session
     * @return string
     */ 
    static function setCsrfToken() : string
    {
        $token = md5(uniqid(rand(), TRUE));
        $_SESSION['csrf_token'] = $token;

        return $token; 
    }

    /**
     * checktokenMatch
     * check posted csrf token with token in the session
     * @param string $token
     * @return boolean
     */ 
    static function checktokenMatch(string $token) : bool 
    {
        return $_SESSION['csrf_token'] === $token;
    }
} 
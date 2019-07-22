<?php

/** 
 * all actions related to session is here
 */

class Session { 
   
    /** 
     * setSessionUser
     * set current user to session
     */
    static function setSessionUser($id) {
        session_start();
        $_SESSION['userId'] = $id;
        $_SESSION['errorMsg'] = '';
        
    }

    /**
     * setErrorMesssage
     * set error message to session
     * @param string $message
     */
    static function setErrorMesssage($message) {
        session_start();
        $_SESSION['errorMsg'] = $message;  
    }

    /**
     *  clearSessionUser
     *  clear datas from session
     */ 
    static function clearSessionUser() {
        session_start();
        session_destroy();
    }
    
    /**
     *  checkisLogged  
     *  check user is logged in or not 
     * @return boolean
     */  
    static function checkisLogged() : bool 
    {
        if(isset($_SESSION['userId'])) {
            return true;
        } else {   
            return false;
        }
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
     * @return boolean
     */ 
    static function checktokenMatch() : bool 
    {
        if($_SESSION['csrf_token'] === $_POST['csrf_token']) {
           return true;
        } else {
            return false; 
        }
    }
} 
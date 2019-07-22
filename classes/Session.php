<?php
//all actions related to session is here
class Session { 
   
    /* set current user to session
       param : user id(int)        */
    static function setSessionUser($id) {
        session_start();
        $_SESSION['userId'] = $id;
        $_SESSION['errorMsg'] = '';
        
    }

    /* set error message to session
       param : message(string)        */
    static function setErrorMesssage($message) {
        session_start();
        $_SESSION['errorMsg'] = $message;  
    }

    /* clear datas from session   */
    static function clearSessionUser() {
        session_start();
        session_destroy();
    }
    
    /* check user is logged in or not  */
    static function checkisLogged() {
        if(isset($_SESSION['userId'])) {
            return true;
        } else {   
            return false;
        }
    }    
} 
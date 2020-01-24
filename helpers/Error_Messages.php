<?php declare(strict_types=1);

namespace edelivery\helpers;

class Error_Messages {

    /**
     * @return string
     */
    public function usernameExists() : string {
        if(isset($_SESSION['username_exists'])) {
            $msg =  "<div class='alert alert-danger'>
            <strong>Username Exists!</strong>
        </div>";
        unset($_SESSION['username_exists']);
            return $msg;
        } 
        return "";
    }

    /**
     * @return string
     */
    public function emailExists() : string {
        if(isset($_SESSION['email_exists'])) {
            $msg = "<div class='alert alert-danger'>
            <strong>Email Exists!</strong>
        </div>";
        unset($_SESSION['email_exists']);
        return $msg;
       
        } 

        return "";
    }
    
    /**
     * @return string
     */
    public function errorMerchant() : string {
        if(isset($_SESSION['error_register_merchant'])) {
            $msg =  "<div class='alert alert-danger'>
            <strong>Error Occured!</strong>
        </div>";
            unset($_SESSION['error_register_merchant']);
            return $msg;
        }

        return "";
    }
    
}

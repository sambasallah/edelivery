<?php declare(strict_types=1);

namespace edelivery\helpers;


class Functions {

    /**
     * @return bool
     */
    public function isMerchantLoggedIn() : bool {
        if(isset($_SESSION['merchant_logged_in']) && $_SESSION['merchant_logged_in'] === TRUE) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isPost() : bool {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            return true;
        }
        return false;
    }

    /**
     * - Checks the profile complete status
     */
    public function profileCompleteStatus() : string {
        if(isset($_SESSION['fill_profile'])) {
            return $_SESSION['fill_profile']; 
        }else {
            return "";
        }
    }

    public function unsetProfileCompleteStatus() : void {
        unset($_SESSION['fill_profile']);
    }



}
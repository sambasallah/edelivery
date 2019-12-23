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
    public function isPartnerLoggedIn() : bool {
        if(isset($_SESSION['partner_logged_in']) && $_SESSION['partner_logged_in'] === TRUE) {
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
     * @return string
     * - Checks the profile complete status
     */
    public function profileCompleteStatus() : string {
        if(isset($_SESSION['fill_profile'])) {
            return $_SESSION['fill_profile']; 
        }else {
            return "";
        }
    }

    /**
     * - Unset profile fill session
     */
    public function unsetProfileCompleteStatus() : void {
        unset($_SESSION['fill_profile']);
    }

    /**
     * @return bool
     * - Checks whether merchant_logged_in session is set
     */
    public function isSetMerchantLoggedIn() : bool {
        if(isset($_SESSION['merchant_logged_in'])) {
            return true;
        }
        return false;
    }

    /**
     * @return string
     * - Returns account balance status
     */
    public function accountBalanceStatus() : string {
        if(isset($_SESSION['insufficient_balance'])) {
            return $_SESSION['insufficient_balance'];
        }
        return "";
    }

    /**
     * - Unset insufficient_balance session variable
     */
    public function unsetAccountBalanceStatus() : void {
        unset($_SESSION['insufficient_balance']);
    }

     /**
     * @return string
     * - Return error message when there is an error while editing your profile information
     */
    public function errorProfile() : string {
        if(isset($_SESSION['profile_error'])) {
            return $_SESSION['profile_error'];
        }
        return "";
    }

    /**
     * - Unset profile_error session variable
     */
    public function unsetErrorProfile() : void {
        unset($_SESSION['profile_error']);
    }

     /**
     * @return string
     * - Returns success message when your profile has been updated successfully
     */
    public function successProfile() : string {
        if(isset($_SESSION['profile_success'])) {
            return $_SESSION['profile_success'];
        }
        return "";
    }

    /**
     * - Unset profile_success session variable
     */
    public function unsetSuccessProfile() : void {
        unset($_SESSION['profile_success']);
    }

}
<?php declare(strict_types=1);

namespace edelivery\helpers;

class Alerts {

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
    
    /**
     * @return string
     */
    public function invalidCredentialsError() : string {
        if(isset($_SESSION['invalid_credentials'])) {
            $msg =  "<div class='alert alert-danger alert-dismissible' style='margin-top: 30px; '>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Error!</strong> Invalid Credentials
            </div>";
            unset($_SESSION['invalid_credentials']);
            return $msg;
        }

        return "";
    }

    /**
     * @return string
     */
    public function partnerNotApproved() : string {
        if(isset($_SESSION['partner_not_approved'])) {
            $msg = "<div class='alert alert-danger alert-dismissible' style='margin-top: 30px; '>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Under Review</strong> 
            </div>";
            unset($_SESSION['partner_not_approved']);
            return $msg;
        }

        return "";
    }

    /**
     * @return string
     */
    public function errorRegisterPartner() : string {
        if(isset($_SESSION['error_register_partner'])) {
            $msg = "<div class='alert alert-danger alert-dismissible' style='margin-top: 30px; '>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Under Review</strong> 
            </div>";
            unset($_SESSION['error_register_partner']);
            return $msg;
        }

        return "";
    }

    /**
     * @return string
     */
    public function deliveryRequestSent() : string {
        if(isset($_SESSION['delivery_request_success'])) {
            $msg = $msg = "<div class='alert alert-success alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Success!</strong> Delivery Request Sent.
          </div>";
          unset($_SESSION['delivery_request_success']);
          return $msg;
        }

        return "";
    }

    /**
     * @return string
     */
    public function deliveryRequestError() : string {
        if(isset($_SESSION['delivery_request_error'])) {
            $msg = "<div class='alert alert-danger alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Error!</strong> There was an error sending your request.
          </div>";
          unset($_SESSION['delivery_request_error']);
          return $msg;
        }

        return "";
    }

    
}

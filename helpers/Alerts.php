<?php declare(strict_types=1);

namespace edelivery\helpers;

class Alerts {

    /**
     * @return string $msg
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
     * @return string $msg
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
     * @return string $msg
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
     * @return string $mgs
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
     * @return string $msg
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
     * @return string $msg
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
     * @return string $msg
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
     * @return string $msg
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

    /**
     * @return string $msg
     */
    public function passwordChanged() : string {
        if(isset($_SESSION['password_successfully_changed'])) {
            $msg = "<div class='alert alert-success alert-dismissible' style='margin-top:30px'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Success!</strong> Password Changed.
          </div>";
          unset($_SESSION['password_successfully_changed']);
          return $msg;
        }

        return "";
    }

    /**
     * @return string
     */
    public function success(): string {
        if(isset($_SESSION['profile_success'])) {
            $msg =  "<div class='alert alert-success alert-dismissible' style='margin-top:30px'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Success!</strong> Profile Updated.
          </div>";
          unset($_SESSION['profile_success']);
          return $msg;
        }

        return "";
    }

    /**
     * @return string
     */
    public function error(): string {
        if(isset($_SESSION['profile_success'])) {
            $msg =  "<div class='alert alert-success alert-dismissible' style='margin-top:30px'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Error!</strong> Profile Not Updated.
          </div>";
          unset($_SESSION['profile_error']);
          return $msg;
        }

        return "";
    }

    /**
     * @return string $msg
     */
    public function cancelDeliveryRequestSuccess(): string {
        if(isset($_SESSION['canceled_request'])) {
            $msg =  "<div class='alert alert-success alert-dismissible' style='margin-top:30px'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Success!</strong> Request Canceled.
          </div>";
          unset($_SESSION['canceled_request']);
          return $msg;
        }

        return "";
    }

       /**
     * @return string $msg
     */
    public function cancelDeliveryRequestError(): string {
        if(isset($_SESSION['request_cancel_error'])) {
            $msg =  "<div class='alert alert-danger alert-dismissible' style='margin-top:30px'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Error!</strong> Cannot Cancel Request.
          </div>";
          unset($_SESSION['request_cancel_error']);
          return $msg;
        }

        return "";
    }

    
    /**
     * @return string $msg
     */
    public function deliveryAcknowledged(): string {
        if(isset($_SESSION['acknowledged'])) {
            $msg =  "<div class='alert alert-success alert-dismissible' style='margin-top:30px'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Success!</strong> Delivery Completed.
          </div>";
          unset($_SESSION['acknowledged']);
          return $msg;
        }

        return "";
    }

    /**
     * @return string $msg
     */
    public function notDelivered(): string {
        if(isset($_SESSION['error_acknowledged'])) {
            $msg =  "<div class='alert alert-success alert-dismissible' style='margin-top:30px'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Success!</strong> Package Not Delivered.
          </div>";
          unset($_SESSION['error_acknowledged']);
          return $msg;
        }

        return "";
    }

    
}

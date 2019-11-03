<?php declare(strict_types=1);

namespace edelivery\models;

class Merchant_Model {

    public $conn;

    public function __construct($db_connection)
    {
        $this->conn = $db_connection;
    } 

    /**
     * @param $data - array
     * - Signin existing merchant
     */
    public function loginMerchant(array $data) : void {
        \extract($data);

        $response = $this->checkLoginDetails($usernameOREmail,$password);

        if($response) {
            $_SESSION['merchant_logged_in'] = TRUE;
            $_SESSION['user'] = $usernameOREmail;
            $this->checkProfileCompleteStatus($usernameOREmail);
            \header("location:merchant");
        }else{
            $_SESSION['invalid_credentials'] = 
            "<div class='alert alert-danger alert-dismissible' style='margin-top: 30px; '>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Error!</strong> Invalid Credentials
            </div>";
            \header("location:login");   
        }
      }
    
    
    /**
     * @param $data - array
     * - Register new merchant
     */
    public function registerMerchant(array $data) : void {
        \extract($data);

        if($this->usernameExists($username)) {
            $_SESSION['username_exists'] = 
            "<div class='alert alert-danger'>
                <strong>Username Exists!</strong>
            </div>";
            header("location:register");
        }elseif($this->emailExists($email)) {
            $_SESSION['email_exists'] = 
            "<div class='alert alert-danger'>
                <strong>Email Exists!</strong> 
            </div>";

            header("location:register"); 
        }else {
            $this->conn->prepareQuery("INSERT INTO merchant 
            SET 
            first_name = :first_name,
            middle_name = :middle_name,
            last_name = :last_name,
            email = :email,
            username = :username,
            password = :password");
        $this->conn->bind(":middle_name", $middle_name);
        $this->conn->bind(":last_name", $last_name);
        $this->conn->bind(":email",$email);
        $this->conn->bind(":first_name", $first_name);
        $this->conn->bind(":username", $username);
        $this->conn->bind(":password", $password);
        
        if($this->conn->executeQuery()) {
            
            $_SESSION['merchant_logged_in'] = TRUE;
            $_SESSION['user']  = $username;
            header("location:merchant");
        }else {
            $_SESSION['error_register'] = 
            "<div class='alert alert-danger'>
                <strong>Error Occured!</strong>
            </div>";
            header("location:register");
        }   
        }
    }

    /**
     * @param $data - array
     * - Updates merchant profile information
     */
    public function updateProfileInformation(array $data, string $current_user) : void {
        \extract($data);

        if(empty($password)) {
            $this->conn->prepareQuery("UPDATE merchant 
            SET
                first_name = :first_name,
                middle_name = :middle_name,
                last_name = :last_name,
                email = :email,
                username = :username,
                dob = :dob,
                address = :address,
                business_name = :business_name,
                business_location = :business_location,
                business_email = :business_email,
                business_phone = :business_phone WHERE username = :current_user OR email = :user_email
            ");
            $this->conn->bind(":username",$username);
            $this->conn->bind(":first_name", $first_name);
            $this->conn->bind(":middle_name",$middle_name);
            $this->conn->bind(":last_name",$last_name);
            $this->conn->bind(":email",$email);
            $this->conn->bind(":dob",$dob);
            $this->conn->bind(":address",$address);
            $this->conn->bind(":business_name",$business_name);
            $this->conn->bind(":business_location",$business_location);
            $this->conn->bind(":business_email",$business_email);
            $this->conn->bind(":business_phone",$business_phone);
            $this->conn->bind(":current_user",$current_user);
            $this->conn->bind(":user_email",$current_user);
        }else {
            $this->conn->prepareQuery("UPDATE merchant 
            SET
                first_name = :first_name,
                middle_name = :middle_name,
                last_name = :last_name,
                email = :email,
                username = :username,
                password = :password,
                dob = :dob,
                address = :address,
                business_name = :business_name,
                business_location = :business_location,
                business_email = :business_email,
                business_phone = :business_phone WHERE username = :current_user OR email = :user_email
            ");
            $this->conn->bind(":username",$username);
            $this->conn->bind(":first_name", $first_name);
            $this->conn->bind(":middle_name",$middle_name);
            $this->conn->bind(":last_name",$last_name);
            $this->conn->bind(":email",$email);
            $this->conn->bind(":password",$password);
            $this->conn->bind(":dob",$dob);
            $this->conn->bind(":address",$address);
            $this->conn->bind(":business_name",$business_name);
            $this->conn->bind(":business_location",$business_location);
            $this->conn->bind(":business_email",$business_email);
            $this->conn->bind(":business_phone",$business_phone);
            $this->conn->bind(":current_user",$current_user);
            $this->conn->bind(":user_email",$current_user);
        }

       if( $this->conn->executeQuery()) {
        $_SESSION['profile_success'] = 
        "<div class='alert alert-success alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Success!</strong> Profile Updated.
      </div>";
           header("location:profile");
       }else {
        $_SESSION['profile_error'] = 
        "<div class='alert alert-danger'>
             <strong>Error Occured!</strong>
         </div>";
         header("location:profile");
       }

       
    }

    /**
     * @param $usernameOREmail - string
     * @return $data - object
     */
    public function getProfileInformation(string $usernameOREmail) : object {
        if(filter_var($usernameOREmail, FILTER_VALIDATE_EMAIL)) {
            $this->conn->prepareQuery("SELECT * FROM merchant WHERE email = :email");
             $this->conn->bind(":email",$usernameOREmail);
             $this->conn->executeQuery();
        }else {
            $this->conn->prepareQuery("SELECT * FROM merchant WHERE username = :username");
            $this->conn->bind(":username",$usernameOREmail);
            $this->conn->executeQuery();
        }
       
        return $this->conn->getResult();

    }

    public function makeDeliveryRequest(array $data, int $merchant_id) : void {
        \extract($data);
 
        $this->conn->prepareQuery("INSERT INTO delivery_requests 
                                    SET
                                        to_location = :to_location,
                                        from_location = :from_location,
                                        receipient_name = :receipient_name,
                                        receipient_mobile_number = :receipient_mobile_number,
                                        receipient_address = :receipient_address,
                                        sender_name = :sender_name,
                                        sender_mobile_number = :sender_mobile_number,
                                        sender_address = :sender_address,
                                        item_name = :item_name,
                                        item_price = :item_price,
                                        item_type = :item_type,
                                        request_status = :request_status,
                                        merchant_id = :merchant_id");
        $this->conn->bind(":to_location", $to);
        $this->conn->bind(":from_location", $from);
        $this->conn->bind(":receipient_name",$receipient_name);
        $this->conn->bind(":receipient_mobile_number",$receipient_mobile_number);
        $this->conn->bind(":receipient_address",$receipient_address);
        $this->conn->bind(":sender_name",$sender_name);
        $this->conn->bind(":sender_mobile_number",$sender_mobile_number);
        $this->conn->bind(":sender_address",$sender_address);
        $this->conn->bind(":item_name",$item_name);
        $this->conn->bind(":item_price",$item_price);
        $this->conn->bind(":item_type", $item_type);
        $this->conn->bind(":request_status",'Pending');
        $this->conn->bind(":merchant_id",$merchant_id);

        if($this->conn->executeQuery()) {
            $_SESSION['delivery_request_success'] = 
            "<div class='alert alert-success alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Success!</strong> Delivery Request Sent.
          </div>";
          header("location:request");
        }else {
            $_SESSION['delivery_request_error'] = 
            "<div class='alert alert-danger alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Error!</strong> There was an error sending your request.
          </div>";
          header("location:request");
        }


    }

    public function generateAPIKey() : void {

    }

    /**
     * @return array;
     */

    public function getAllDeliveryRequests() : array {
        $this->conn->prepareQuery("SELECT * FROM delivery_requests");
        $this->conn->executeQuery();

        if($this->conn->rows() >= 1) {
            return $this->conn->getResults();
        }

        return [];
    }


    /**
     * @param $request_id - int
     */
    public function cancelDeliveryRequest(int $request_id) : void {
        $this->conn->prepareQuery("DELETE FROM delivery_requests WHERE id = :request_id");
        $this->conn->bind(":request_id", $request_id);
        if($this->conn->executeQuery()) {
            $_SESSION['canceled_request'] = 
            "<div class='alert alert-success alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Success!</strong> Delivery Request Canceled.
          </div>";
          header("location:summary");
        }else {
            $_SESSION['request_cancel_error'] = 
            "<div class='alert alert-danger alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Error!</strong> Failed To Cancel Request.
          </div>";
          header("location:summary");
        }
    }


    public function getTotalSpentOnDeliveries(string $query) : void {

    }

    public function getAccountBalance(string $query) : void {
        
    }

    /**
     * @param $usernameOREmail - string
     * @return merchant_id - int
     */
    public function getMerchantID(string $usernameOREmail) : int {
        $this->conn->prepareQuery("SELECT * FROM merchant WHERE username = :username OR email = :email");
        $this->conn->bind(":username",$usernameOREmail);
        $this->conn->bind(":email",$usernameOREmail);
        $this->conn->executeQuery();
        $result = $this->conn->getResult();
        return intval($result->merchant_id);
    }

    /**
     * @param $username - string
     * @return bool
     * - Checks whether username exists
     */
    private function usernameExists(string $username) : bool {
        $this->conn->prepareQuery("SELECT * FROM merchant WHERE username = :username"); 
        $this->conn->bind(":username",$username);

        $this->conn->executeQuery();

        if($this->conn->rows() == 1) {
            return true;
        }
        
        return false;
    }

    /**
     * @param $email - string
     * @return bool
     * - Checks whether user email exists
     */
    private function emailExists(string $email) : bool {
        $this->conn->prepareQuery("SELECT * FROM merchant WHERE email = :email"); 
        $this->conn->bind(":email",$email);

        $this->conn->executeQuery();

        if($this->conn->rows() == 1) {
            return true;
        }

        return false;
    }

    /**
     * @param emailORusername - string
     * @param password - string
     * @return bool
     * 
     * - Verifies login credentials
     * 
     */
    private function checkLoginDetails(string $emailORUsername, string $password) : bool {
        if(filter_var($emailORUsername, FILTER_VALIDATE_EMAIL)) {
            $this->conn->prepareQuery("SELECT * FROM merchant WHERE email = :email");
             $this->conn->bind(":email",$emailORUsername);
             $this->conn->executeQuery();
             if($this->conn->rows() == 1) {
                $result = $this->conn->getResult();
                }else {
                    return false;
                }
        }else {
            $this->conn->prepareQuery("SELECT * FROM merchant WHERE username = :username");
            $this->conn->bind(":username",$emailORUsername);
            $this->conn->executeQuery();
            if($this->conn->rows() == 1) {
                $result = $this->conn->getResult();
            }else {
                return false;
            }
        }   

        if(\password_verify($password,$result->password)) {
            return true;
        }

        return false;
        
    }

    /**
     * @param username - string
     * - Checks whether the profile information is completely filled
     */
    private function checkProfileCompleteStatus(string $usernameOREmail) : void {
        $this->conn->prepareQuery("SELECT * FROM merchant WHERE username = :username OR email = :email");
        $this->conn->bind(":username", $usernameOREmail);
        $this->conn->bind(":email", $usernameOREmail);
        $this->conn->executeQuery();

        $result = $this->conn->getResult();

        if(empty($result->dob) || empty($result->address) || empty($result->business_name) || empty($result->business_location) || empty($result->business_phone) || empty($result->business_email)) {
            $_SESSION['fill_profile'] = 
            "<div class='alert alert-success'>
                <strong>Your Profile Is Incomplete</strong>
            </div>";
        }
    }

    /**
     * @param $password - string
     * @return bool
     */
    public function isPasswordChanged(string $password) : bool {
        $this->conn->prepareQuery("SELECT * FROM merchant WHERE password = :password");
        $this->conn->bind(":password",$password);
        $this->conn->executeQuery();

        if($this->conn->rows() == 1) {
            return false;
        }

        return true;
    }

}
 
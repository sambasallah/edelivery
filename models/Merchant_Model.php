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
                                        merchant_id = :merchant_id,
                                        rate_id = :rate_id");
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
        $this->conn->bind(":rate_id",$rate_id);

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

    public function getAllDeliveryRequests(int $merchant_id) : array {
        $this->conn->prepareQuery("SELECT *,delivery_rates.rate FROM delivery_requests INNER JOIN delivery_rates ON delivery_requests.rate_id = delivery_rates.rate_id WHERE merchant_id = :merchant_id");
        $this->conn->bind(":merchant_id",$merchant_id);
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

    /**
     * @param $merchant_id - int
     * @return $account_balance - int
     */
    public function getAccountBalance(int $merchant_id) : int {
        $this->conn->prepareQuery("SELECT account_balance FROM merchant WHERE merchant_id = :merchant_id");
        $this->conn->bind(":merchant_id",$merchant_id);
        $this->conn->executeQuery();

        $result = $this->conn->getResult();

        return intval($result->account_balance);
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

    /**
     * @param $to - string
     * @param $from - string
     * @return int
     * - Returns the delivery rate_id
     */
    public function calculateDeliveryRate(string $to, string $from) : int {
        $this->conn->prepareQuery("SELECT rate_id FROM delivery_rates WHERE to_town = :to AND from_town = :from");
        $this->conn->bind(":to",$to);
        $this->conn->bind(":from",$from);
        $this->conn->executeQuery();

        $result = $this->conn->getResult();

        return intval($result->rate_id);


    }

    /**
     * @param $data - array
     * @return int 
     * - Calculate the total amount spent on deliveries
     */
    public function calculateTotalSpentOnDeliveries(array $data) : int {
        $total_spent = 0;
        foreach($data as $row) {
            $this->conn->prepareQuery("SELECT rate FROM delivery_rates WHERE rate_id = :id");
            $this->conn->bind(":id",$row->rate_id);
            $this->conn->executeQuery();
            $result = $this->conn->getResult();
            $total_spent += intval($result->rate);
        }

        return $total_spent;
    }

    public function updateTotalSpentAmount(string $total_spent, int $merchant_id) : bool {
        $this->conn->prepareQuery("UPDATE merchant 
                                    SET
                                    total_spent = :total_spent 
                                    WHERE merchant_id = :merchant_id 
                            ");
        $this->conn->bind(":total_spent",$total_spent);
        $this->conn->bind(":merchant_id",$merchant_id);
        
        if( $this->conn->executeQuery()) {
            return true;
        }

        return false;


        
    }

    /**
     * @param $merchant_id - int
     * @return int
     * - Return's the total spent 
     */
    public function totalSpent(int $merchant_id) : int {
        $this->conn->prepareQuery("SELECT rate_id FROM delivery_requests WHERE merchant_id = :merchant_id");
        $this->conn->bind(":merchant_id",$merchant_id);
        $this->conn->executeQuery();

        $total_spent = $this->calculateTotalSpentOnDeliveries($this->conn->getResults());

        return $total_spent;

    }

    
}
 
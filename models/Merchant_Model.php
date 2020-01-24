<?php declare(strict_types=1);

namespace edelivery\models;

use edelivery\models\Auth_Model;

class Merchant_Model {

    protected object $conn;
    private int $NUMBER_OF_RECORDS_PER_PAGE = 7;
    private int $total_pages = 0;
    private object $auth;

    public function __construct($db_connection)
    { 
        $this->conn = $db_connection;
        $this->auth = new Auth_Model($db_connection);
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
     * Register Merchant
     * @param array $data
     */
    public function registerMerchant(array $data) : void {
        \extract($data);

        if($this->usernameExists($username)) {
            $_SESSION['username_exists'] = TRUE;
            // \header("location:register");
        }elseif($this->emailExists($email)) {
            $_SESSION['email_exists'] = TRUE;
            // \header("location:register"); 
        }else {

            $success = $this->auth->registerUser(['username' => $username, 'email' => $email, 'password' => $password, 'type' => 'merchant']);
            
            if($success) {
                $this->conn->prepareQuery("INSERT INTO merchant 
                SET 
                first_name = :first_name,
                middle_name = :middle_name,
                last_name = :last_name,
                email = :email,
                username = :username,
                password = :password,
                account_balance = :balance");
            $this->conn->bind(":middle_name", $middle_name);
            $this->conn->bind(":last_name", $last_name);
            $this->conn->bind(":email",$email);
            $this->conn->bind(":first_name", $first_name);
            $this->conn->bind(":username", $username);
            $this->conn->bind(":password", $password);
            $this->conn->bind(":balance","10000");
            
                if($this->conn->executeQuery()) {   
                    $_SESSION['merchant_logged_in'] = TRUE;
                    $_SESSION['user']  = $username;
                    \header("location:merchant");
               }  else {
                 \header('location:register');
               }
            } else {
                $_SESSION['error_register_merchant'] = TRUE;
                \header("location:register");
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
           \header("location:profile");
       }else {
        $_SESSION['profile_error'] = 
        "<div class='alert alert-danger'>
             <strong>Error Occured!</strong>
         </div>";
         \header("location:profile");
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

    /**
     * @param $data - array
     * @param $merchant_id - int
     */
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
                                        package_type = :package_type,
                                        pick_up_date = :pick_up_date,
                                        package_size = :package_size,
                                        request_status = :request_status,
                                        merchant_id = :merchant_id,
                                        rate_id = :rate_id,
                                        delivery_note = :delivery_note,
                                        payment_method = :payment_method,
                                        item_name = :item_name");
        $this->conn->bind(":to_location", $to);
        $this->conn->bind(":from_location", $from);
        $this->conn->bind(":receipient_name",$receipient_name);
        $this->conn->bind(":receipient_mobile_number",$receipient_mobile_number);
        $this->conn->bind(":receipient_address",$receipient_address);
        $this->conn->bind(":sender_name",$sender_name);
        $this->conn->bind(":sender_mobile_number",$sender_mobile_number);
        $this->conn->bind(":sender_address",$sender_address);
        $this->conn->bind(":package_type",$package_type);
        $this->conn->bind(":pick_up_date",$pick_up_date);
        $this->conn->bind(":package_size", $package_size);
        $this->conn->bind(":request_status",'Pending');
        $this->conn->bind(":merchant_id",$merchant_id);
        $this->conn->bind(":rate_id",$rate_id);
        $this->conn->bind(":delivery_note",$delivery_note);
        $this->conn->bind(":payment_method",$payment_method);
        $this->conn->bind(":item_name", $item_name);

        if($this->conn->executeQuery()) {
            $delivery_rate = $this->calculateDeliveryRate($to,$from);
            $this->updateBalance($delivery_rate, $merchant_id);
            $this->updateTotalSpentAmount(strval($delivery_rate),$merchant_id);
            $_SESSION['delivery_request_success'] = 
            "<div class='alert alert-success alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Success!</strong> Delivery Request Sent.
          </div>";
          \header("location:request");
        }else {
            $_SESSION['delivery_request_error'] = 
            "<div class='alert alert-danger alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Error!</strong> There was an error sending your request.
          </div>";
          \header("location:request");
        }


    }

    public function generateAPIKey() : void {

    }

    /**
     * @param $merchant_id - int
     * @return array;
     */

    public function getAllDeliveryRequests(int $merchant_id, int $page_no) : array {
        $total_rows = $this->getTotalRows($merchant_id);
        $offset = ($page_no-1) * $this->NUMBER_OF_RECORDS_PER_PAGE;
        $this->total_pages = (int) ceil($total_rows / $this->NUMBER_OF_RECORDS_PER_PAGE);
        $this->conn->prepareQuery("SELECT *,delivery_rates.rate FROM delivery_requests INNER JOIN delivery_rates ON delivery_requests.rate_id = delivery_rates.rate_id WHERE merchant_id = :merchant_id ORDER BY request_time DESC LIMIT :offset,:total_records_per_page ");
        $this->conn->bind(":merchant_id",$merchant_id);
        $this->conn->bind(":offset",$offset);
        $this->conn->bind(":total_records_per_page", $this->NUMBER_OF_RECORDS_PER_PAGE);
        $this->conn->executeQuery();

        if($this->conn->rows() >= 1) {
            return $this->conn->getResults();
        }

        return [];
    }

    /**
     * @param $merchant_id - int
     * @return int 
     * - Returns the total rows
     */
    private function getTotalRows(int $merchant_id) : int {
        $this->conn->prepareQuery("SELECT * FROM delivery_requests WHERE merchant_id = :id");
        $this->conn->bind(":id",$merchant_id);
        $this->conn->executeQuery();

        return $this->conn->rows();
    }

    /**
     * @return int
     * - Returns the total number of pages
     */
    public function getTotalPages() : int {
        return $this->total_pages;
    }   

    /**
     * @return int
     * - Returns the number of ongoing deliveries
     */
    public function getOngoingDeliveries(int $merchant_id) : int {
        $this->conn->prepareQuery("SELECT * FROM delivery_requests WHERE request_status = 'On Route' AND merchant_id = :id ");
        $this->conn->bind(":id", $merchant_id);
        $this->conn->executeQuery();

        return $this->conn->rows();
    }

    /**
     * @param $merchant_id - int
     * @return object
     */
    public function getDeliveryRequest(int $merchant_id) : object {
        $this->conn->prepareQuery("SELECT *,partner.* FROM delivery_requests INNER JOIN partner ON partner.partner_id = delivery_requests.partner_id WHERE delivery_requests.id = :merchant_id");
        $this->conn->bind(":merchant_id",$merchant_id);
        $this->conn->executeQuery();

        if($this->conn->rows() == 1) {
            return $this->conn->getResult();
        }

        return null;
    }

    public function sendComplaint(string $complaint_text, int $partner_id, int $merchant_id) : void {
        $partner_info = $this->getPartnerInfo($partner_id);
        $merchant_info = $this->getMerchantInfo($merchant_id);
        $this->conn->prepareQuery("UPDATE complaints SET
                                                        partner_name = :name,
                                                        partner_number = :number,
                                                        complaint_text = :text, 
                                                        partner_email = :email,
                                                        merchant_name = :merchant_name,
                                                        merchant_email = :merchant_email,
                                                        merchant_number = :merchant_number WHERE partner_id = :id");
        $this->conn->bind(":name", $partner_info->first_name . " " . $partner_info->last_name);
        $this->conn->bind(":number",$partner_info->phone_number);
        $this->conn->bind(":text", $complaint_text);
        $this->conn->bind(":email",$partner_info->email);
        $this->conn->bind(":merchant_name", $merchant_info->first_name . ' '.$merchant_info->last_name);
        $this->conn->bind(":merchant_email", $merchant_info->business_email);
        $this->conn->bind(":merchant_number", $merchant_info->business_phone);
        $this->conn->bind(":id",$partner_id);
        if($this->conn->executeQuery()) {
            $_SESSION['complaint_sent'] = 
            "<div class='alert alert-success alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Success!</strong> Complaint Sent.
          </div>";
            \header("location:summary");
        } else {
            $_SESSION['complaint_not_sent'] = 
            "<div class='alert alert-danger alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Success!</strong> Complaint Not Sent.
          </div>";
            \header('location:summary');
        }
    }

    /**
     * @param $merchant_id - int
     */
    public function openComplaint(int $request_id, int $partner_id) : void {
        $success = $this->notReceived($request_id);
        $this->conn->prepareQuery("INSERT INTO complaints SET
                                                            partner_id = :id"); 
        $this->conn->bind(":id",$partner_id);

        if($success &&  $this->conn->executeQuery()) {
            $_SESSION['partner_id'] = $partner_id;
            header("location:complaint");
        } else {
            header("location:summary");
        }
    }

    /**
     * @param $partner_id - int
     * @return object
     */
    public function getPartnerInfo(int $partner_id) : object {
        $this->conn->prepareQuery("SELECT first_name,last_name,email,phone_number FROM partner WHERE partner_id = :id");
        $this->conn->bind(":id",$partner_id);

        if($this->conn->executeQuery()) {
            return $this->conn->getResult();
        }

        throw new \Exception("ID not found");
    }

     /**
     * @param $merchant_id - int
     * @return object
     */
    public function getMerchantInfo(int $merchant_id) : object {
        $this->conn->prepareQuery("SELECT first_name,last_name,business_email,business_phone FROM merchant WHERE merchant_id = :id");
        $this->conn->bind(":id",$merchant_id);

        if($this->conn->executeQuery()) {
            return $this->conn->getResult();
        }

        throw new \Exception("ID not found");
    }


    /**
     * @param $merchant_id - int
     * @param bool
     */
    private function notReceived(int $request_id) : bool {
        $this->conn->prepareQuery("UPDATE delivery_requests SET
                                                    received = :received WHERE id = :id");
        $this->conn->bind(":received","No");
        $this->conn->bind(":id",$request_id);

        if($this->conn->executeQuery()) {
           return true;
        } 

        return false;
    }


    /**
     * @param $request_id - int
     * - cancels a delivery request
     */
    public function cancelDeliveryRequest(int $request_id, int $merchant_id) : void {
        $refund_amount = $this->getRefundAmount($request_id);
        $this->conn->prepareQuery("DELETE FROM delivery_requests WHERE id = :request_id");
        $this->conn->bind(":request_id", $request_id);
        if($this->conn->executeQuery()) {
            $this->refund($refund_amount,$merchant_id);
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

    /**
     * @param $request_id - int
     * @return int
     * - gets the amount to refund
     */
    private function getRefundAmount(int $request_id) : int {
        $this->conn->prepareQuery("SELECT rate FROM delivery_requests INNER JOIN delivery_rates ON delivery_requests.rate_id = delivery_rates.rate_id WHERE id = :request_id");
        $this->conn->bind(":request_id",$request_id);
        $this->conn->executeQuery();

        $result = $this->conn->getResult();

        return intval($result->rate);
    }

    /**
     * @param $amount - int
     * @param $merchant_id - int
     * @return bool
     * - refund the amount
     */
    private function refund(int $amount, int $merchant_id) : bool {
        $account_balance = $this->getAccountBalance($merchant_id);
        $account_balance += $amount;
        $this->conn->prepareQuery("UPDATE merchant SET account_balance = :new_balance WHERE merchant_id = :merchant_id");  
        $this->conn->bind(":new_balance",$account_balance);
        $this->conn->bind(":merchant_id",$merchant_id);
        
        if($this->conn->executeQuery()) {
            return true;
        }

        return false;
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
        $this->conn->prepareQuery("SELECT * FROM users WHERE username = :username"); 
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
        $this->conn->prepareQuery("SELECT * FROM users WHERE email = :email"); 
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
        $this->conn->prepareQuery("SELECT rate FROM delivery_rates WHERE to_town = :to AND from_town = :from");
        $this->conn->bind(":to",$to);
        $this->conn->bind(":from",$from);
        $this->conn->executeQuery();

        $result = $this->conn->getResult();

        return intval($result->rate);
    }

    /**
     * @param $to - string
     * @param $from - string
     * @return int
     * - Returns the delivery rate_id
     */
    public function getDeliveryRateID(string $to, string $from) : int {
        $this->conn->prepareQuery("SELECT rate_id FROM delivery_rates WHERE to_town = :to AND from_town = :from");
        $this->conn->bind(":to",$to);
        $this->conn->bind(":from",$from);
        $this->conn->executeQuery();

        $result = $this->conn->getResult();

        return intval($result->rate_id);
    }

    /**
     * @param $merchant_id - int
     * - Calculate the total amount spent on deliveries
     */
    public function calculateTotalSpentOnDeliveries(int $merchant_id) : float {
       $this->conn->prepareQuery("SELECT SUM(rate) as total_spent FROM delivery_rates INNER JOIN delivery_requests ON delivery_requests.rate_id = delivery_rates.rate_id WHERE merchant_id = :id");
       $this->conn->bind(":id",$merchant_id);
       $this->conn->executeQuery();
    
       $result = $this->conn->getResult();
    
       if($result->total_spent == null ) {
           return 0.00;
       };
       return $result->total_spent;
    }

    /**
     * @param $total_spent - string
     * @param $merchant_id - int
     * - Updates the total amount spent on deliveries
     */
    private function updateTotalSpentAmount(string $total_spent, int $merchant_id) : bool {
        $total_amt_spent = $this->calculateTotalSpentOnDeliveries($merchant_id);
        $total_amt_spent += intval($total_spent);
        $this->conn->prepareQuery("UPDATE merchant 
                                    SET
                                    total_spent = :total_spent 
                                    WHERE merchant_id = :merchant_id 
                            ");
        $this->conn->bind(":total_spent",strval($total_amt_spent));
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

        $total_spent = $this->calculateTotalSpentOnDeliveries($this->conn->getResults(),$merchant_id);

        return \intval($total_spent);

    }

    /**
     * @param $total_spent - int
     * @return bool
     * - Updates the account balance
     */
    private function updateBalance(int $total_spent,int $merchant_id) : bool {
        $account_balance = $this->getAccountBalance($merchant_id);
        $account_balance -= $total_spent;
        $this->conn->prepareQuery("UPDATE merchant
                                    SET 
                                    account_balance = :balance WHERE merchant_id = :id");
        $this->conn->bind(":balance",$account_balance);
        $this->conn->bind(":id",$merchant_id);
        
        if($this->conn->executeQuery()) {
            return true;
        }

        return false;
    }


    /**
    *@param $merchant_id - int
    *@param $request_id - int
    *@return bool
    *- Checks whether balance is sufficient to make delivery request
    */
    public function isAccountBalanceSufficient(int $merchant_id,int $requestAmount) : bool {
        $account_balance = $this->getAccountBalance($merchant_id);

        if(($account_balance - $requestAmount) >= 0) {
            return true;
        }

        return false;
    }


    /**
     * @param $request_id - int
     * @return bool
     */
    public function acknowledgeDelivery(int $request_id) : bool {
        $this->conn->prepareQuery("UPDATE delivery_requests
                                                            SET
                                                            received = :received WHERE id = :id");
        $this->conn->bind(":received","Yes");
        $this->conn->bind(":id", $request_id);

        if($this->conn->executeQuery()) {
            return true;
        }

        return false;
    }

    /**
     * @return array
     * - Returns total weekly delivery requests
     */
    public function getTotalWeeklyDeliveryRequests(string $merchant_id) : array {
        $this->conn->prepareQuery("SELECT request_time,COUNT(*) AS total_daily_requests,DAYOFWEEK(request_time) AS day
        FROM delivery_requests
        WHERE request_time >= Date_add(Now(),interval - 7 day) AND request_time <= NOW() AND merchant_id = :id
        group by DATE(request_time)
        ");

        $this->conn->bind(":id",$merchant_id);

        if($this->conn->executeQuery()) {
            return $this->conn->getResults();
        }

        return [];
    }
    
}
 
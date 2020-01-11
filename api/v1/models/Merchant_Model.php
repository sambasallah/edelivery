<?php declare(strict_types=1);

namespace edelivery\api\v1\models;

class Merchant_Model {

    private object $conn;

    public function __construct(object $db_connection)
    {
        $this->conn = $db_connection;
    }


    /**
     * @param $data - array
     * @return bool
     */
    public function userExists(array $data) : bool {
        \extract($data);
        
        return $this->checkLoginDetails($usernameOREmail,$password);
    }


     /**
     * @param $username - string
     * @return bool
     * - Checks whether username exists
     */
    private function usernameExists(string $usernameOREmail) : bool {
        $this->conn->prepareQuery("SELECT * FROM merchant WHERE username = :username OR email = :userEmail AND NOT NULL jwt-token"); 
        $this->conn->bind(":username",$usernameOREmail);
        $this->conn->bind(":userEmail", $usernameOREmail);

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
     * @param $usernameOREmail - string
     * @return string
     */
    public function getMerchantID(string $usernameOREmail) : int {
        $this->conn->prepareQuery("SELECT * FROM merchant WHERE username = :username OR email =:email");
        $this->conn->bind(":username",$usernameOREmail);
        $this->conn->bind(":email",$usernameOREmail);

        $this->conn->executeQuery();

        return intval($this->conn->getResult()->merchant_id);
    }

    /**
     * @param $request_id - int
     * - cancels a delivery request
     */
    public function cancelDeliveryRequest(int $request_id, int $merchant_id) : bool {
        $refund_amount = $this->getRefundAmount($request_id);
        $this->conn->prepareQuery("DELETE FROM delivery_requests WHERE id = :request_id");
        $this->conn->bind(":request_id", $request_id);
        if($this->conn->executeQuery()) {
            $this->refund($refund_amount,$merchant_id);
            return true;
        }

        return false;
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
     * @param $request_id - int
     * @return string
     */
    public function track(int $request_id) : string {
        $this->conn->prepareQuery("SELECT request_status FROM delivery_requests WHERE id = :id");
        $this->conn->bind(":id", $request_id);
        $this->conn->executeQuery();

        return strval($this->conn->getResult()->request_status);
    }

    /**
     * @param $data - array
     * @return bool
     */
    public function makeDeliveryRequest(array $data) : bool {
        \extract($data);
        
        $merchant_id = $this->getMerchantID($merchant_username);

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
                                        payment_method = :payment_method");
        $this->conn->bind(":to_location", $to_location);
        $this->conn->bind(":from_location", $from_location);
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
        $this->conn->bind(":payment_method","Cash On Delivery");

        if($this->conn->executeQuery()) {
            $delivery_rate = $this->calculateDeliveryRate($to_location,$from_location);
            $this->updateBalance($delivery_rate, $merchant_id);
            $this->updateTotalSpentAmount(strval($delivery_rate),$merchant_id);
           
            return true;
        }

        return false;

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
 
    

}
<?php declare(strict_types=1);

namespace edelivery\models;

use edelivery\models\Auth_Model;

class Partner_Model {

    private object $conn;
    private int $NUMBER_OF_RECORDS_PER_PAGE = 5;
    private int $total_pages = 0;
    private object $auth;

    public function __construct($db_connection) 
    {
        $this->conn = $db_connection;
        $this->auth = new Auth_Model($db_connection);
    }
    
    /**
     * @param $usernameOREmail - string
     * @return bool
     */
    public function isAccountApproved(int $partner_id) : bool {
        $this->conn->prepareQuery("SELECT * FROM partner WHERE partner_id = :id AND account_status = :status");
        $this->conn->bind(":status","Approved");
        // $this->conn->bind(":username",$usernameOREmail);
        $this->conn->bind(":id",$partner_id);

        $this->conn->executeQuery();

        if($this->conn->rows() == 1) {
            return true;
        }

        return false;
    }

    /**
     * @param array $data
     * @param array $national_document
     * @param array $valid_drivers_license
     */
    public function registerPartner(array $data,array $national_document, array $valid_drivers_license) : void {
        \extract($data);
        
        $success = $this->auth->registerUser(['username' => $username, 'email' => $email_address, 'password' => $password, 'type' => 'partner']);
        
        if($success) {
            $national_document = $this->uploadNationalDocument($national_document);
            $drivers_license = $this->uploadDriversLicense($valid_drivers_license);
            
            if(!empty($national_document) && !empty($drivers_license)) {
                $this->conn->prepareQuery("INSERT INTO partner 
                                                    SET 
                                                    first_name = :first_name,
                                                    last_name = :last_name,
                                                    email = :email_address,
                                                    username = :username,
                                                    password = :password,
                                                    phone_number = :phone,
                                                    municipality = :municipality,
                                                    license = :license,
                                                    national_document = :national_document,
                                                    account_status = :status,
                                                    earnings = :balance,
                                                    withdrawals = :withdrawals,
                                                    vehicle_type = :vehicle_type ");

                $this->conn->bind(":first_name", $first_name);
                $this->conn->bind(":last_name", $last_name);
                $this->conn->bind(":email_address",$email_address);
                $this->conn->bind(":username", $username);
                $this->conn->bind(":password", $password);
                $this->conn->bind(":status","Under Review");
                $this->conn->bind(":municipality", $municipality);
                $this->conn->bind(":phone",$phone_number);
                $this->conn->bind(":license", $drivers_license);
                $this->conn->bind(":national_document", $national_document);
                $this->conn->bind(":balance","0");
                $this->conn->bind(":withdrawals","0");
                $this->conn->bind(":vehicle_type",$vehicle_type);
             } else {
                \header('location:register-partner');
            }

            if($this->conn->executeQuery()) {
                $_SESSION['partner_logged_in'] = TRUE;
                $_SESSION['user']  = $username;
                \header("location:partner");
            }else {
                $_SESSION['error_register_partner'] = TRUE;
                \header('location:register-partner');
            }   
        } 

    }

    /**
     * @param array $data
     * @param array $profile_arr
     */
    public function updateProfileInformation(array $data, array $profile_arr) : void {
        \extract($data);
        if(empty($password)) {
                if(empty($profile_arr['profile_picture']['name'])) {
                  $success = $this->auth->updateUser(['username' => $username,'password' => '', 'email'=> $email, 'type' => 'partner']);
                  if($success) {
                    $this->conn->prepareQuery("UPDATE partner SET 
                    first_name = :first_name,
                    last_name = :last_name,
                    username = :username,
                    email = :email,
                    phone_number = :phone_number
                     WHERE partner_id = :id");
                    $this->conn->bind(":first_name",$first_name);
                    $this->conn->bind(":last_name",$last_name);
                    $this->conn->bind(":username",$username);
                    $this->conn->bind(":email",$email);
                    $this->conn->bind(":phone_number",$phone_number);
                    $this->conn->bind(":id",$partner_id);
                  } else {
                      $_SESSION['error'] = 
                      "<div class='alert alert-success alert-dismissible'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Error!</strong> occured.
                    </div>";
                    \header('location:profile');
                  }
                } else {
                    $succes = $this->auth->updateUser(['username' => $username, 'email' => $email, 'password' => '', 'type' => 'partner']);
                    
                    if($succes) {
                        $profile_picture = $this->uploadPartnerProfilePicture($profile_arr);
                        $this->conn->prepareQuery("UPDATE partner SET 
                        first_name = :first_name,
                        last_name = :last_name,
                        username = :username,
                        email = :email,
                        phone_number = :phone_number,
                        profile_picture = :picture
                         WHERE partner_id = :id");
                        $this->conn->bind(":first_name",$first_name);
                        $this->conn->bind(":last_name",$last_name);
                        $this->conn->bind(":username",$username);
                        $this->conn->bind(":email",$email);
                        $this->conn->bind(":phone_number",$phone_number);
                        $this->conn->bind(":id",$partner_id);
                        $this->conn->bind(":picture", $profile_picture);
                    } else {
                        $_SESSION['error'] = 
                        "<div class='alert alert-success alert-dismissible'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Error!</strong> occured.
                    </div>";
                    \header('location:profile');
                    }
                }
            } else {    
                if(empty($profile_arr['profile_picture']['name'])) {
                    $success = $this->auth->updateUser(['username' => $username, 'email' => $email, 'password' => $password, 'type' => 'partner']);

                    if($success) {
                        $this->conn->prepareQuery("UPDATE partner SET 
                        first_name = :first_name,
                        last_name = :last_name,
                        username = :username,
                        email = :email,
                        password = :password,
                        phone_number = :phone_number
                        WHERE partner_id = :id");
                        $this->conn->bind(":first_name",$first_name);
                        $this->conn->bind(":last_name",$last_name);
                        $this->conn->bind(":username",$username);
                        $this->conn->bind(":email",$email);
                        $this->conn->bind(":password", $password);
                        $this->conn->bind(":phone_number",$phone_number);
                        $this->conn->bind(":id",$partner_id);
                    } else {
                        $_SESSION['error'] = 
                        "<div class='alert alert-danger alert-dismissible'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>Error!</strong> occured.
                    </div>";
                    \header('location:profile');
                    }
                    
                } else {

                    $success = $this->auth->updateUser(['username' => $username, 'email' => $email, 'password' => $password, 'type' => 'partner']);

                    if($success) {
                        $profile_picture = $this->uploadPartnerProfilePicture($profile_arr);
                        $this->conn->prepareQuery("UPDATE partner SET 
                        first_name = :first_name,
                        last_name = :last_name,
                        username = :username,
                        email = :email,
                        password = :password,
                        phone_number = :phone_number,
                        profile_picture = :picture
                         WHERE partner_id = :id");
                        $this->conn->bind(":first_name",$first_name);
                        $this->conn->bind(":last_name",$last_name);
                        $this->conn->bind(":username",$username);
                        $this->conn->bind(":email",$email);
                        $this->conn->bind(":password", $password);
                        $this->conn->bind(":phone_number",$phone_number);
                        $this->conn->bind(":id",$partner_id);
                        $this->conn->bind(":picture", $profile_picture);
                    } else {
                        $_SESSION['error'] = 
                        "<div class='alert alert-danger alert-dismissible'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            <strong>Error!</strong> occured.
                        </div>";
                        \header('location:profile');
                    }
                   
                }
            }

        if($this->conn->executeQuery()) {
            $_SESSION['updated'] = 
            "<div class='alert alert-success alert-dismissible'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong> updated.
            </div>";
            \header('location:profile');
        } else {
            $_SESSION['error'] = 
            "<div class='alert alert-danger alert-dismissible'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Error!</strong> occured.
            </div>";
            \header('location:profile');
        }
    }   

    /**
     * @param $password - string
     * @return bool
     */
    public function isPasswordChanged(string $password) : bool {
        $this->conn->prepareQuery("SELECT * FROM partner WHERE password = :password");
        $this->conn->bind(":password",$password);
        $this->conn->executeQuery();

        if($this->conn->rows() == 1) {
            return false;
        }

        return true;
    }
    
    /**
     * @param $page_no - int
     * @return array
     */
    public function getAllDeliveryRequests(int $page_no) : array {
        $total_rows = $this->getDeliveryRequestRows();
        $offset = ($page_no-1) * $this->NUMBER_OF_RECORDS_PER_PAGE;
        $this->total_pages = (int) ceil($total_rows / $this->NUMBER_OF_RECORDS_PER_PAGE);
        $this->conn->prepareQuery("SELECT * FROM delivery_requests WHERE partner_id IS NULL LIMIT :offset, :number_of_records");
        $this->conn->bind(":offset",$offset);
        $this->conn->bind(":number_of_records",$this->NUMBER_OF_RECORDS_PER_PAGE);
        $this->conn->executeQuery();

        return $this->conn->getResults();
    }

    /**
     * @param $request_id - int
     * @return object
     */
    public function getDeliveryRequest(int $request_id) : object {
        $this->conn->prepareQuery("SELECT * FROM delivery_requests WHERE id = :request_id");
        $this->conn->bind(":request_id",$request_id);
        $this->conn->executeQuery();

        return $this->conn->getResult();
    }

    /**
     * @param $current_user - int
     * @return array
     */
    public function getEarningSummary(int $current_user, int $page_no) : array {
        $total_rows = $this->getTotalPages($current_user);
        $offset = ($page_no-1) * $this->NUMBER_OF_RECORDS_PER_PAGE;
        $this->total_pages = (int) ceil($total_rows / $this->NUMBER_OF_RECORDS_PER_PAGE);
        $this->conn->prepareQuery("SELECT * FROM earnings WHERE partner_id = :id LIMIT :offset, :number_of_records");
        $this->conn->bind(":id",$current_user);
        $this->conn->bind(":offset",$offset);
        $this->conn->bind(":number_of_records",$this->NUMBER_OF_RECORDS_PER_PAGE);
        $this->conn->executeQuery();

        return $this->conn->getResults();
    }
    
    /**
     * @param $current_user - int
     * @param $merchant_id - int
     */
    public function acceptDeliveryRequest(int $current_user, int $request_id) : void {
        $this->conn->prepareQuery("UPDATE delivery_requests 
                                                SET 
                                                 partner_id = :id,
                                                 request_status = :status
                                                  WHERE id = :request_id");
        $this->conn->bind(":id",$current_user);
        $this->conn->bind(":request_id",$request_id);
        $this->conn->bind(":status","On Route");
        
        if($this->conn->executeQuery()) {
            \header("location:delivery-requests");
        }
        \header("location:delivery-requests");

    }

    /**
     * @param $data - array
     * @param $partner_id - int
     */
    public function requestWithdrawal(array $data, int $partner_id) : void {
        \extract($data);
        if($this->isBalanceSufficient($amount, $partner_id)) {
            $this->conn->prepareQuery('INSERT INTO withdrawal_requests
                                                                SET
                                                                name = :name,
                                                                withdrawal_amount = :amount,
                                                                bank_name = :bank,
                                                                account_number = :account,
                                                                bban_number = :bban,
                                                                request_status = :status,
                                                                partner_id = :id');
            $this->conn->bind(":name",$name);
            $this->conn->bind(":amount",$amount);
            $this->conn->bind(":bank",$bank_name);
            $this->conn->bind(":account",$account_number);
            $this->conn->bind(":bban",$bban_number);
            $this->conn->bind(":id",$partner_id);
            $this->conn->bind(":status","Under Review");

            if($this->conn->executeQuery()) {
                $_SESSION['withdrawal_request'] = 
                "<div class='alert alert-success alert-dismissible'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong> withdrawal request sent.
            </div>";
                \header("location:dashboard");
            } else {
                $_SESSION['withdrawal_error'] = 
            "<div class='alert alert-danger alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Error!</strong> request cannot be sent.
             </div>";
        \header("location:dashboard");
            }
        } else {
            $_SESSION['insufficient_balance'] = 
            "<div class='alert alert-danger alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Error!</strong> withdrawal amount is more than your account balance.
             </div>";
            \header("location:dashboard");
        }

        
    }

    public function updateWithdrawalRequest(array $data, int $partner_id) : void {
        \extract($data);
        if($this->isBalanceSufficient($amount,intval($partner_id))) {
            $this->conn->prepareQuery("UPDATE withdrawal_requests 
                                                        SET
                                                        name = :name,
                                                        withdrawal_amount = :amount,
                                                        bank_name = :bank,
                                                        bban_number = :bban,
                                                        account_number = :account WHERE partner_id = :id");
        $this->conn->bind(":name",$name);
        $this->conn->bind(":amount",$amount);
        $this->conn->bind(":bank",$bank_name);
        $this->conn->bind(":bban",$bban_number);
        $this->conn->bind(":account", $account_number);
        $this->conn->bind(":id",$partner_id);

        if($this->conn->executeQuery()) {
            $_SESSION['update_success'] = 
            "<div class='alert alert-success alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Success!</strong> withdrawal request updated.
        </div>";
            \header('location:withdrawals');
        } else {
            $_SESSION['balance_error'] = 
            "<div class='alert alert-danger alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Error!</strong> there was an error...
        </div>";
            \header('location:withdrawals');
            }
        } else {
            $_SESSION['update_error'] = 
        "<div class='alert alert-danger alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Error!</strong> withdrawal amount is greater than balance.
    </div>";
        \header('location:withdrawals');
        }
    }

    public function deleteWithdrawalRequest(int $request_id) : void {
        $this->conn->prepareQuery('DELETE FROM withdrawal_requests WHERE id = :id'); 
        $this->conn->bind(":id",$request_id);

        if($this->conn->executeQuery()) {
            $_SESSION['delete_success'] = 
            "<div class='alert alert-success alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Success!</strong> deleted successfully.
        </div>";
        \header("location:withdrawals");
        } else {
            $_SESSION['delete_error'] = 
        "<div class='alert alert-danger alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Error!</strong> there was an error.
    </div>";
    \header("location:withdrawals");
        }

        
    }

    /**
     * @param $request_id - int
     * @return object
     */
    public function getWithdrawalRequest(int $request_id) : object {
        $this->conn->prepareQuery("SELECT * FROM withdrawal_requests WHERE id = :id");
        $this->conn->bind(":id",$request_id);

        if($this->conn->executeQuery()) {
            return $this->conn->getResult();
        }
    }

    /**
     * @param $partner_id - int
     * @return bool
     */
    public function idExists(int $partner_id) : bool {
        $this->conn->prepareQuery("SELECT * FROM withdrawal_requests WHERE id = :id");
        $this->conn->bind(":id",$partner_id);

        $this->conn->executeQuery();

        if($this->conn->rows() == 1) {
            return true;
        }

        return false;
    }

    /**
     * @param $current_user - int
     * @return bool
     */
    private function isBalanceSufficient(string $amount, int $current_user) : bool {
        $account_balance = $this->getTotalEarnings($current_user);
        $total_withdrawals = $this->getTotalWithdrawals($current_user);
        $balance = intval($account_balance) - intval($total_withdrawals);

        if($balance >= $amount) {
            return true;
        }
        return false;
    }

    /**
     * @param $partner_id - int
     * @return array
     */
    public function getWithdrawals(int $partner_id) : array {
        $this->conn->prepareQuery('SELECT * FROM withdrawal_requests WHERE partner_id = :id');
        $this->conn->bind(":id",$partner_id);

        if($this->conn->executeQuery()) {
            return $this->conn->getResults();
        }

        return [];
    }
    
    /**
     * @param $current_user - int
     * @return array
     */
    public function getAcceptedRequests(int $current_user, int $page_no) : array {
        $total_rows = $this->getTotalRows($current_user);
        $offset = ($page_no-1) * $this->NUMBER_OF_RECORDS_PER_PAGE;
        $this->total_pages = (int) ceil($total_rows / $this->NUMBER_OF_RECORDS_PER_PAGE);
        $this->conn->prepareQuery("SELECT *,delivery_rates.* FROM delivery_requests INNER JOIN delivery_rates ON delivery_rates.rate_id = delivery_requests.rate_id WHERE partner_id = :id ORDER BY id DESC LIMIT :offset, :number_of_records");
        $this->conn->bind(":id",$current_user);
        $this->conn->bind(":offset",$offset);
        $this->conn->bind(":number_of_records",$this->NUMBER_OF_RECORDS_PER_PAGE);
        $this->conn->executeQuery();

        return $this->conn->getResults();
    }

    /**
     * @param $current_user - int
     * @return array
     */
    public function acceptedARequest(int $current_user) : bool {
        $this->conn->prepareQuery("SELECT * FROM delivery_requests WHERE partner_id = :id AND request_status = :status");
        $this->conn->bind(":id",$current_user);
        $this->conn->bind(":status","On Route");
        $this->conn->executeQuery();

        if($this->conn->rows() == 1) {
            return true;
        }

        return false;
    }

    /**
     * @param $arrival_time - string
     * @param $request_id - int
     */
    public function updateArrivalTime(string $arrival_time, int $request_id) : void {
        $this->conn->prepareQuery("UPDATE delivery_requests SET
                                                            arrival_time = :time WHERE id = :id");
        $this->conn->bind(":time",$arrival_time);
        $this->conn->bind(":id",$request_id);

        if($this->conn->executeQuery()) {
            $_SESSION['update_success'] = 
            "<div class='alert alert-success alert-dismissible'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <strong>Success!</strong> Arrival Time Updated.
        </div>";
        \header("location:../accepted");
        exit;
        }

        $_SESSION['update_error'] = 
        "<div class='alert alert-danger alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Error!</strong> An error occured.
    </div>";
    \header("location:../accepted");
    exit;

    }
    
    /**
     * @param $user - string
     * @return string
     */
    public function getTotalEarnings(int $current_user) : string {
        $this->conn->prepareQuery("SELECT earnings FROM partner WHERE partner_id = :id");
        $this->conn->bind(":id",$current_user);
        $this->conn->executeQuery();

        $result = $this->conn->getResult();

        return strval($result->earnings);
    }   

    /**
     * @param $current_user - int
     * @param $earned - int
     */
    public function updateEarnings(int $current_user, int $earned) : void {
        $total_earnings = $earned + $this->getTotalEarnings($current_user);
        $this->conn->prepareQuery("UPDATE partner 
                                            SET
                                            earnings = :earnings 
                                            WHERE partner_id = :id");
        $this->conn->bind(":earnings",$total_earnings);
        $this->conn->bind(":id",$current_user);

        $this->conn->executeQuery();
    }

    /**
     * @param $data - array
     * @param $current_user - int
     */
    public function earningsSummary(array $data, int $current_user) : void {
        \extract($data);
        $this->conn->prepareQuery("INSERT INTO earnings 
                                            SET 
                                            to_location = :to_location,
                                            from_location = :from_location,
                                            package_size = :package_size,
                                            package_type = :package_type,
                                            rate = :rate,
                                            earned = :earned,
                                            partner_id = :id");
        $this->conn->bind(":to_location",$to_location);
        $this->conn->bind(":from_location", $from_location);
        $this->conn->bind(":package_size",$package_size);
        $this->conn->bind(":package_type",$package_type);
        $this->conn->bind(":rate",$rate);
        $this->conn->bind(":earned",$earned);
        $this->conn->bind(":id",$current_user);

        $this->conn->executeQuery();
    }

    /**
     * @param $current_user - int
     * @return object
     */
    public function getProfileInformation(int $current_user) : object {
        $this->conn->prepareQuery("SELECT * FROM partner WHERE partner_id = :id");
        $this->conn->bind(":id",$current_user);

        return $this->conn->getResult();
    }

    /**
     * @param $current_user - int
     * @return bool
     */
    public function delivered(int $current_user) : void {
        $this->conn->prepareQuery("UPDATE delivery_requests 
                                                SET
                                                request_status = :status 
                                                WHERE partner_id = :id");
        $this->conn->bind(":status","Delivered");
        $this->conn->bind(":id",$current_user);

        if($this->conn->executeQuery()) {
            \header("location:accepted");
        }

        \header("location:accepted");
    }

    /**
     * @param $user - string
     * @return int
     */
    public function getPartnerID(string $user) : int {
        if($this->usernameExists($user) || $this->emailExists($user)) {
            $this->conn->prepareQuery("SELECT partner_id FROM partner WHERE username = :username OR email = :email");
        $this->conn->bind(":username",$user);
        $this->conn->bind(":email",$user);
        $this->conn->executeQuery();

        $result = $this->conn->getResult();
        
        return intval($result->partner_id);

        } else {
            return 0;
        }
    }

    /**
     * @param $user - string
     * @return string
     */
    public function getTotalWithdrawals(int $current_user) : string {
        $this->conn->prepareQuery("SELECT withdrawals FROM partner WHERE partner_id = :id");
        $this->conn->bind(":id",$current_user);
        $this->conn->executeQuery();

        $result = $this->conn->getResult();

        return strval($result->withdrawals);
    }

    /**
     * @param $user - string
     * @return string
     */
    public function getBalance(int $current_user) : string {
        $total_earnings = $this->getTotalEarnings($current_user);
        $total_withdrawals = $this->getTotalWithdrawals($current_user);

        $balance = intval($total_earnings) - intval($total_withdrawals);

        return strval(abs($balance));
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
            $this->conn->prepareQuery("SELECT * FROM partner WHERE email = :email");
             $this->conn->bind(":email",$emailORUsername);
             $this->conn->executeQuery();
             if($this->conn->rows() == 1) {
                $result = $this->conn->getResult();
                }else {
                    return false;
                }
        }else {
            $this->conn->prepareQuery("SELECT * FROM partner WHERE username = :username");
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
     * @param $username - string
     * @return bool
     * - Checks whether username exists
     */
    public function usernameExists(string $username) : bool {
        $this->conn->prepareQuery("SELECT * FROM partner WHERE username = :username"); 
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
    public function emailExists(string $email) : bool {
        $this->conn->prepareQuery("SELECT * FROM partner WHERE email = :email"); 
        $this->conn->bind(":email",$email);

        $this->conn->executeQuery();

        if($this->conn->rows() == 1) {
            return true;
        }

        return false;
    }

    /**
     * @param $license - array
     * @return String
     */
    private function uploadDriversLicense(array $license) : string {
        $file_name = explode(".",$license['valid_drivers_license']['name']);
        $targetDir = dirname(dirname(__FILE__))."/storage/public/uploads/licenses/". $file_name[0].rand(0,time()).'.'.$file_name[1];

        if($license['valid_drivers_license']['size'] > 1000000) {
            return "File Too Large";
        }

        if(file_exists($targetDir)) {
            return "File Exists";
        }

        if($license['valid_drivers_license']['type'] == "image/jpeg" || $license['valid_drivers_license']['type'] == "image/png" || $license['valid_drivers_license']['type'] == "application/pdf") {
            if(move_uploaded_file($license['valid_drivers_license']['tmp_name'],$targetDir)) {
                return explode("/",$targetDir)[5];
            }else {
                return "";
            }
        }
    }

     /**
     * @param $profile - array
     * @return String
     */
    public function uploadPartnerProfilePicture(array $profile) : string {
        $file_name = explode(".",$profile['profile_picture']['name']);
        $targetDir = dirname(dirname(__FILE__))."/storage/public/uploads/profile/". $file_name[0].rand(0,time()).'.'.$file_name[1];

        if($profile['profile_picture']['size'] > 1000000) {
            return "File Too Large";
        }

        if($profile['profile_picture']['error'] != 0) {
            return "An Error Occured";
        }

        if(file_exists($targetDir)) {
            return "File Exist";
        }

        if($profile['profile_picture']['type'] == "image/jpg" || $profile['profile_picture']['type'] == "image/jpeg"  || $profile['profile_picture']['type'] == "image/png" ) {
            if(move_uploaded_file($profile['profile_picture']['tmp_name'],$targetDir)) {
                return explode("/",$targetDir)[5];
            }else {
                return "partner_avatar.png";
            }
        } else {
            return "Invalid Image Type";
        }
    }

    /**
     * @param $national_document - array
     * @return string
     */
    private function uploadNationalDocument(array $national_document) : string {
        $file_name = explode(".",$national_document['national_document']['name']);
        $targetDir = dirname(dirname(__FILE__))."/storage/public/uploads/documents/". $file_name[0].rand(0,time()).'.'.$file_name[1];

        if($national_document['national_document']['size'] > 1000000) {
            return "";
        }

        if(file_exists($targetDir)) {
            return "";
        }

        if($national_document['national_document']['type'] == "image/jpeg" || $national_document['national_document']['type'] == "image/png" || $national_document['national_document']['type'] == "application/pdf") {
            if(move_uploaded_file($national_document['national_document']['tmp_name'],$targetDir)) {
                return explode("/",$targetDir)[5];
            }else {
                return "";
            }
        }
    }

     /**
     * @return array
     * - Returns total weekly delivery requests
     */
    public function getTotalWeeklyEarnings(int $partner_id) : array {
        $this->conn->prepareQuery("SELECT request_time,SUM(earned) AS daily_earnings,DAYOFWEEK(request_time) AS day
        FROM earnings
        WHERE request_time >= Date_add(Now(),interval - 7 day) AND request_time <= NOW() AND partner_id = :id
        group by DATE(request_time)
        ");

        $this->conn->bind(":id",$partner_id);

        if($this->conn->executeQuery()) {
            return $this->conn->getResults();
        }

        return [];
    }

     /**
     * @param $partner_id - int
     * @return int 
     * - Returns the total rows
     */
    private function getTotalRows(int $partner_id) : int {
        $this->conn->prepareQuery("SELECT * FROM delivery_requests WHERE partner_id = :id");
        $this->conn->bind(":id",$partner_id);
        $this->conn->executeQuery();

        return $this->conn->rows();
    }

      /**
     * @return int 
     * - Returns the total rows
     */
    private function getDeliveryRequestRows() : int {
        $this->conn->prepareQuery("SELECT * FROM delivery_requests WHERE partner_id IS NULL");
        $this->conn->executeQuery();

        return $this->conn->rows();
    }

    /**
     * @return int
     */
    public function getTotalPages() : int {
        return $this->total_pages;
    }
}


<?php declare(strict_types=1);

namespace edelivery\models;

class Partner_Model {

    private $conn;

    public function __construct($db_connection) 
    {
        $this->conn = $db_connection;
    }

    public function loginPartner(array $data) : void {
        \extract($data);

        $response = $this->checkLoginDetails($usernameOREmail,$password);

        if($response) {
            $_SESSION['partner_logged_in'] = TRUE;
            $_SESSION['user'] = $usernameOREmail;
            \header("location:partner");
        }else{
            $_SESSION['invalid_credentials'] = 
            "<div class='alert alert-danger alert-dismissible' style='margin-top: 30px; '>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Error!</strong> Invalid Credentials
            </div>";
            \header("location:login");   
        }
    }
    

    public function registerPartner(array $data,array $national_document, array $valid_drivers_license) : void {
        \extract($data);
        if($this->usernameExists($username)) {
            $_SESSION['username_exists'] = 
            "<div class='alert alert-danger'>
                <strong>Username Exists!</strong>
            </div>";
            \header("location:register-partner");
        }elseif($this->emailExists($email_address)) {
            $_SESSION['email_exists'] = 
            "<div class='alert alert-danger'>
                <strong>Email Exists!</strong> 
            </div>";

            \header("location:register-partner"); 
        }else {
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
            withdrawals = :withdrawals ");

                $this->conn->bind(":first_name", $first_name);
                $this->conn->bind(":last_name", $last_name);
                $this->conn->bind(":email_address",$email_address);
                $this->conn->bind(":username", $username);
                $this->conn->bind(":password", $password);
                $this->conn->bind(":status","Pending");
                $this->conn->bind(":municipality", $municipality);
                $this->conn->bind(":phone",$phone_number);
                $this->conn->bind(":license", $drivers_license);
                $this->conn->bind(":national_document", $national_document);
                $this->conn->bind(":balance","0");
                $this->conn->bind(":withdrawals","0");

        if($this->conn->executeQuery()) {
            
            $_SESSION['partner_logged_in'] = TRUE;
            $_SESSION['user']  = $username;
            \header("location:partner");
        }else {
            $_SESSION['error_register'] = 
            "<div class='alert alert-danger'>
                <strong>Error Occured!</strong>
            </div>";
            \header("location:register-partner");
        }   
            }
        }
    }

    public function updateProfileInformation(array $data, int $current_user) : void {
        \extract($data);
        if(empty($password)) {
            $this->conn->prepareQuery("UPDATE partner SET 
                                                    first_name = :first_name,
                                                    last_name = :last_name,
                                                    username = :username,
                                                    email = :email,
                                                    phone_number = :phone_number WHERE partner_id = :id");
            $this->conn->bind(":first_name",$first_name);
            $this->conn->bind(":last_name",$last_name);
            $this->conn->bind(":username",$username);
            $this->conn->bind(":email",$email);
            $this->conn->bind(":phone_number",$phone_number);
            $this->conn->bind(":id",$current_user);
         } else {
            $this->conn->prepareQuery("UPDATE partner SET 
            first_name = :first_name,
            last_name = :last_name,
            username = :username,
            password = :password,
            email = :email,
            phone_number = :phone_number WHERE partner_id = :id");
            $this->conn->bind(":first_name",$first_name);
            $this->conn->bind(":last_name",$last_name);
            $this->conn->bind(":username",$username);
            $this->conn->bind("password",$password);
            $this->conn->bind(":email",$email);
            $this->conn->bind(":phone_number",$phone_number);
            $this->conn->bind(":id",$current_user);
         }

         if($this->conn->executeQuery()) {
            $_SESSION['profile_success'] = 
                "<div class='alert alert-success alert-dismissible'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Success!</strong> Profile Updated.
            </div>";
           \header("location:profile");
         } else {
            $_SESSION['profile_error'] = 
            "<div class='alert alert-danger'>
                 <strong>Error Occured!</strong>
             </div>";
             \header("location:profile");
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
     * @return array
     */
    public function getAllDeliveryRequests() : array {
        $this->conn->prepareQuery("SELECT * FROM delivery_requests WHERE partner_id IS NULL");
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
    public function getEarningSummary(int $current_user) : array {
        $this->conn->prepareQuery("SELECT * FROM earnings WHERE partner_id = :id");
        $this->conn->bind(":id",$current_user);

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
     * @param $current_user - int
     * @return array
     */
    public function getAcceptedRequests(int $current_user) : array {
        $this->conn->prepareQuery("SELECT *,delivery_rates.* FROM delivery_requests INNER JOIN delivery_rates ON delivery_rates.rate_id = delivery_requests.rate_id WHERE partner_id = :id ORDER BY id DESC ");
        $this->conn->bind(":id",$current_user);

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
        $this->conn->prepareQuery("SELECT partner_id FROM partner WHERE username = :username OR email = :email");
        $this->conn->bind(":username",$user);
        $this->conn->bind(":email",$user);
        $this->conn->executeQuery();

        $result = $this->conn->getResult();

        return intval($result->partner_id);
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

        return strval($balance);
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
    private function usernameExists(string $username) : bool {
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
    private function emailExists(string $email) : bool {
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
        $targetDir = dirname(dirname(__FILE__))."/public/uploads/licenses/". $file_name[0].rand(0,time()).'.'.$file_name[1];

        if($license['valid_drivers_license']['size'] > 1000000) {
            return "";
        }

        if(file_exists($targetDir)) {
            return "";
        }

        if($license['valid_drivers_license']['type'] == "image/jpeg" || $license['valid_drivers_license']['type'] == "application/pdf") {
            if(move_uploaded_file($license['valid_drivers_license']['tmp_name'],$targetDir)) {
                return explode("/",$targetDir)[4];
            }else {
                return "";
            }
        }
    }

    /**
     * @param $national_document - array
     * @return string
     */
    private function uploadNationalDocument(array $national_document) : string {
        $file_name = explode(".",$national_document['national_document']['name']);
        $targetDir = dirname(dirname(__FILE__))."/public/uploads/documents/". $file_name[0].rand(0,time()).'.'.$file_name[1];

        if($national_document['national_document']['size'] > 1000000) {
            return "";
        }

        if(file_exists($targetDir)) {
            return "";
        }

        if($national_document['national_document']['type'] == "image/jpeg" || $national_document['national_document']['type'] == "application/pdf") {
            if(move_uploaded_file($national_document['national_document']['tmp_name'],$targetDir)) {
                return explode("/",$targetDir)[4];
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
}


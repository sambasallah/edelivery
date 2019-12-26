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
            municipality = :municipality,
            license = :license,
            national_document = :national_document,
            account_status = :status ");

                $this->conn->bind(":first_name", $first_name);
                $this->conn->bind(":last_name", $last_name);
                $this->conn->bind(":email_address",$email_address);
                $this->conn->bind(":first_name", $first_name);
                $this->conn->bind(":username", $username);
                $this->conn->bind(":password", $password);
                $this->conn->bind(":status","Pending");
                $this->conn->bind(":municipality", $municipality);
                $this->conn->bind(":license", $drivers_license);
                $this->conn->bind(":national_document", $national_document);
        
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
    // public function getAllDeliveryRequests(string $query) : array {
        
    // }

    // public function getEarningSummary(string $query) : array {

    // }

    // public function updateProfile(array $data) : bool {

    // }

    // public function getTotalEarnings(string $query) : array {

    // }

    // public function getWithdrawalAmount(string $query) : array {

    // }

    // public function getBalance(string $query) : array {

    // }

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

    private function uploadDriversLicense(array $license) : string {
        $file_name = explode(".",$license['valid_drivers_license']['name']);
        $targetDir = dirname(dirname(__FILE__)) . "/public/uploads/licenses/". $file_name[0].rand(0,time()).'.'.$file_name[1];
        
        if($license['valid_drivers_license']['size'] > 50000) {
            return "";
        }

        if(file_exists($targetDir)) {
            return "";
        }

        if($license['valid_drivers_license']['type'] == "image/jpeg" || $license['valid_drivers_license']['type'] == "application/pdf") {
            if(move_uploaded_file($license['valid_drivers_license']['tmp_name'],$targetDir)) {
                return explode("/",$targetDir)[2];
            }else {
                return "";
            }
        }

    }

    private function uploadNationalDocument(array $national_document) : string {
        $file_name = explode(".",$national_document['national_document']['name']);
        $targetDir = dirname(dirname(__FILE__))."/public/uploads/documents/". $file_name[0].rand(0,time()).'.'.$file_name[1];

        if($national_document['national_document']['size'] > 50000) {
            return "";
        }

        if(file_exists($targetDir)) {
            return "";
        }

        if($national_document['national_document']['type'] == "image/jpeg" || $national_document['national_document']['type'] == "application/pdf") {
            if(move_uploaded_file($national_document['national_document']['tmp_name'],$targetDir)) {
                return explode("/",$targetDir)[2];
            }else {
                return "";
            }
        }
    }
}


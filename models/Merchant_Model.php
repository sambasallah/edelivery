<?php declare(strict_types=1);

namespace edelivery\models;

class Merchant_Model {

    public $conn;

    public function __construct(object $db_connection)
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
            business_phone = :business_phone WHERE username = :current_user
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

    public function makeDeliveryRequest(array $data) : void {
        
    }

    public function generateAPIKey() : void {

    }

    public function getOngoingDeliveries(string $query) : void {

    }

    public function getTotalSpentOnDeliveries(string $query) : void {

    }

    public function getAccountBalance(string $query) : void {
        
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
        $this->conn->prepareQuery("SELECT * FROM merchant WHERE username = :username"); 
        $this->conn->bind(":username",$email);

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
            $this->conn->prepareQuery("SELECT email,password FROM merchant WHERE email = :email");
             $this->conn->bind(":email",$emailORUsername);
             $this->conn->executeQuery();
        }else {
            $this->conn->prepareQuery("SELECT username,password FROM merchant WHERE username = :username");
            $this->conn->bind(":username",$emailORUsername);
            $this->conn->executeQuery();
        }
       
        $result = $this->conn->getResult();
    

        if(\password_verify($password,$result->password)) {
            return true;
        }

        // if($password === $result->password) {
        //     return true;
        // }

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
        }else {
            $_SESSION['fill_profile'] = 
            "<div class='alert alert-success'>
                <strong>Welcome Admin</strong>
            </div>"; 
        }
    }

}
 
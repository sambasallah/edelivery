<?php declare(strict_types=1);

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

    public function registerPartner(array $data) : void {
        
    }

    public function getAllDeliveryRequests(string $query) : array {
        
    }

    public function getEarningSummary(string $query) : array {

    }

    public function updateProfile(array $data) : bool {

    }

    public function getTotalEarnings(string $query) : array {

    }

    public function getWithdrawalAmount(string $query) : array {

    }

    public function getBalance(string $query) : array {

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
}
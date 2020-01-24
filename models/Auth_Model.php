<?php declare(strict_types=1);

namespace edelivery\models;

class Auth_Model {

    private object $conn;


    public function __construct(object $connection) {
        $this->conn = $connection;
    }

    /**
     * @param array $data User Data
     * @return bool
     */
    public function registerUser(array $data) : bool {
            \extract($data);
       
            $this->conn->prepareQuery("INSERT INTO users 
                                            SET username = :username,
                                            email = :email,
                                            password = :password,
                                            user_type = :type");

            $this->conn->bind(":username", $username);
            $this->conn->bind(":email", $email);
            $this->conn->bind(":password", $password);
            $this->conn->bind(":type", $type);

            if($this->conn->executeQuery()) {
                return true;
            }

            return false;
            
        }

    /**
     * @param array $data
     */
    public function loginUser(array $data, string $user_type) : void {
        \extract($data);

        $valid = $this->checkLoginDetails($usernameOREmail, $password);

        if($valid) {
            $_SESSION['user_logged_in'] = TRUE;
            $_SESSION['user'] = $usernameOREmail;
            \header('location:'.$user_type);
        } else {
            $_SESSION['invalid_credentials'] = 
            "<div class='alert alert-danger alert-dismissible' style='margin-top: 30px; '>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Error!</strong> Invalid Credentials
            </div>";
        }
    }

     /**
     * Checks Where User Credentials Are Valid
     * 
     * @param string $emailORusername 
     * @param string $password
     * @return bool
     */
    private function checkLoginDetails(string $emailORUsername, string $password) : bool {
        if(filter_var($emailORUsername, FILTER_VALIDATE_EMAIL)) {
            $this->conn->prepareQuery("SELECT * FROM users WHERE email = :email");
             $this->conn->bind(":email",$emailORUsername);
             $this->conn->executeQuery();
             if($this->conn->rows() == 1) {
                $result = $this->conn->getResult();
                }else {
                    return false;
                }
        }else {
            $this->conn->prepareQuery("SELECT * FROM users WHERE username = :username");
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

}
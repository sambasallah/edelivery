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
            
            if($this->emailExists($email)) {
                $_SESSION['email_exists'] = TRUE;
                return false;
            } else if ($this->usernameExists($username)) {
                $_SESSION['username_exists'] = TRUE;
                return false;
            } else {
                $this->conn->prepareQuery("INSERT INTO users 
                SET username = :username,
                email = :email,
                password = :password,
                user_type = :type");

                $this->conn->bind(":username", $username);
                $this->conn->bind(":email", $email);
                $this->conn->bind(":password", $password);
                $this->conn->bind(":type", $type);

                return $this->conn->executeQuery();
            }
        }

    /**
     * @param array $data
     */
    public function loginUser(array $data, string $user_type) : void {
        \extract($data);

        $valid = $this->checkLoginDetails($usernameOREmail, $password);

        if($valid) {
            if($user_type == 'partner') {
                $_SESSION['partner_logged_in'] = TRUE;
                $_SESSION['user'] = $usernameOREmail;
                \header('location:'.$user_type);
            } else {
                $_SESSION['merchant_logged_in'] = TRUE;
                $_SESSION['user'] = $usernameOREmail;
                \header('location:'.$user_type);
            }
        } else {
            $_SESSION['invalid_credentials'] =  TRUE;
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
        return \password_verify($password,$result->password);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function updateUser(array $data) : bool {
        \extract($data);
        
        if(!empty($password)) {
            $this->conn->prepareQuery("UPDATE users SET
            email = :email,
            password = :password WHERE username = :username");
            $this->conn->bind(":email", $email);
            $this->conn->bind(":password", $password);
            $this->conn->bind(":username", $username);
        } else {
            $this->conn->prepareQuery("UPDATE users SET
            email = :email
            WHERE username = :username");
            $this->conn->bind(":email", $email);
            $this->conn->bind(":username", $username);
        }

        return $this->conn->executeQuery();
    }

        /**
     * @param string $email
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
     * @param string $username
     * @return bool
     * - Checks whether user email exists
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

}
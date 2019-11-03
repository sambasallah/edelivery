<?php declare(strict_types=1);

namespace edelivery\tests\models;

class Merchant_Model {

    private $conn;

    public function __construct($db_connection) 
    {
        $this->conn = $db_connection;
    }
    
    /**
     * @param $data - array
     * @return bool
     * - Login's merchant
     */
    public function loginMerchant(array $data) : bool {
        \extract($data);
        $login = $this->checkLoginDetails($username,$password);

        if($login) {
            $this->checkProfileCompleteStatus($username);
            return true;
        }
        return false;
    }

    /**
     * @param $username, $password - string
     * @return bool
     * - Check whether login details are valid
     */
    public function checkLoginDetails(string $username, $password) : bool {
       
        if(!empty($username) && !empty($password)) {
            return $this->conn->query($username . ' '. $password);
        }

        return false;
    }

    /**
     * @param $username - string
     * @return bool
     * - Check whether profile information is all filled
     */
    public function checkProfileCompleteStatus(string $username) : bool {
        if(!empty($username)) {
            return $this->conn->query($username);
        }

        return false;
    }

    /**
     * @param $data - array
     * @return bool
     * - Register a new merchant
     */
    public function registerMerchant(array $data) : bool {
        if(is_array($data)) {
            return $this->conn->query("Insert Data");
        }

        return false;
        
    }

    /**
     * @param $data - array
     * @param $user - string
     * @return bool
     * - Updates the merchant profile information
     */
    public function updateProfileInformation(array $data, string $user) : bool {
        if(is_array($data) && !empty($user)) {
            return $this->conn->query("Update Profile Information");
        }

        return false;
    }

    /**
     * @param $usernameOREmail - string
     * @return bool
     * - Get the profile information of a particular merchant
     */
    public function getProfileInformation(string $usernameOREmail) : bool {
            if(!empty($usernameOREmail)) {
                return $this->conn->query("Get profile information with $usernameOREmail");
            }

            return false;
    }

    /**
     * @param $data - array
     * @param $merchant_id - int
     * @return bool
     * - Make's delivery request
     */
    public function makeDeliveryRequest(array $data,int $merchant_id) : bool {
        if(is_array($data) && is_int($merchant_id)) {
            return $this->conn->query("Make delivery request");
        }

        return false;
    }

    /**
     * @return bool
     * - Get's all delivery requests
     */
    public function getAllDeliveryRequests() : bool {
        if($this->conn->query("Get all delivery request")) {
            return true;
        }

        return false;
    }

    /**
     * @param $request_id - int
     * @return bool
     * - Cancel's a particular delivery request
     */
    public function cancelDeliveryRequest(int $request_id) : bool {
        if(is_int($request_id)) {
            return $this->conn->query("Delete Request");
        }

        return false;
    }

    /**
     * @param $usernameOREmail - string
     * @return $merchant_id - int
     * - Returns the merchant ID
     */
    public function getMerchantID(string $usernameOREmail) : int {
        if(!empty($usernameOREmail)) {
            $this->conn->query("Get merchant id");
            return 1;
        }

        return 0;
    }

    /**
     * @param $username - string
     * @return bool
     * - Check's whether username exists in the database
     */
    public function usernameExists(string $username) : bool {
        if(!empty($username)) {
            return $this->conn->query("Check username");
        }

        return false;
    }

    /**
     * @param $email - string
     * @return bool
     * - Check's whether email exists
     */
    public function emailExists(string $email) : bool {
        if(!empty($email)) {
            return $this->conn->query("Check email");
        }
        return false;
    }

    /**
     * @param $password - string
     * @return bool
     * - Check's whether the password has been changed
     */
    public function isPasswordChanged(string $password) : bool {
        if(!empty($password)) {
            return $this->conn->query("Check whether password is changed");
        }

        return false;
    }
}
 
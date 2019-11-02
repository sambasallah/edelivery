<?php declare(strict_types=1);

namespace edelivery\tests\models;

class Merchant_Model {

    private $conn;

    public function __construct($db_connection) 
    {
        $this->conn = $db_connection;
    }

    public function loginMerchant(array $data) : bool {
        \extract($data);
        $login = $this->checkLoginDetails($username,$password);

        if($login) {
            $this->checkProfileInformation($username);
            return true;
        }
        return false;
    }

    public function checkLoginDetails(string $username, $password) : bool {
       
        if(!empty($username) && !empty($password)) {
            return $this->conn->query($username . ' '. $password);
        }

        return false;
    }

    public function checkProfileInformation(string $username) : bool {
        return $this->conn->query($username);
    }



        
}
 
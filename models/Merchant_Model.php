<?php declare(strict_types=1);

class Merchant_Model {

    private $conn;

    public function __construct(object $db_connection)
    {
        $this->conn = $db_connection;
    } 

    public function loginMerchant(array $data) : void {
      
    }

    public function registerMerchant(array $data) : void {

    }

    public function makeDeliveryRequest(array $data) : void {

    }

    public function generateAPIKey() : string {

    }

    public function getOngoingDeliveries(string $query) : int {

    }

    public function getTotalSpentOnDeliveries(string $query) : string {

    }

    public function getAccountBalance(string $query) : string {
        
    }
}
<?php declare(strict_types=1);

class Partner_Model {

    private $conn;

    public function __construct($db_connection) 
    {
        $this->conn = $db_connection;
    }

    public function loginPartner(array $data) : void {

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
}
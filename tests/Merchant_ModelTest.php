<?php declare(strict_types=1);

include '../config/init_.php';

use PHPUnit\Framework\TestCase;
use edelivery\tests\models\Database_Model;
use edelivery\tests\models\Merchant_Model;

class Merchant_ModelTest extends TestCase {

    public function test_login_merchant() {
        $database = new Database_Model();
        $merchant = new Merchant_Model($database);
        
        self::assertTrue($merchant->loginMerchant(["username" => "samba", "password"=>"1234"]));
    }

    public function test_check_login_details() {
        $database = new Database_Model();
        $merchant = new Merchant_Model($database);

        self::assertTrue($merchant->checkLoginDetails("username","password"));
    }

    public function test_profile_information() {
        $database = new Database_Model();
        $merchant = new Merchant_Model($database);

        self::assertTrue($merchant->checkProfileInformation("username"));
    }

}
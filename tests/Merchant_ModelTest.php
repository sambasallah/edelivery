<?php declare(strict_types=1);

include '../config/init_.php';

use PHPUnit\Framework\TestCase;
use edelivery\tests\models\Database_Model;
use edelivery\tests\models\Merchant_Model;

class Merchant_ModelTest extends TestCase {

    // Test loginMerchant()
    public function test_login_merchant() {
        $database = new Database_Model();
        $merchant = new Merchant_Model($database);
        
        self::assertTrue($merchant->loginMerchant(["username" => "samba", "password"=>"1234"]));
    }

    // Test checkLoginDetails()
    public function test_check_login_details() {
        $database = new Database_Model();
        $merchant = new Merchant_Model($database);

        self::assertTrue($merchant->checkLoginDetails("username","password"));
    }

    // Test checkProfileCompleteStatus()
    public function test_profile_information() {
        $database = new Database_Model();
        $merchant = new Merchant_Model($database);

        self::assertTrue($merchant->checkProfileCompleteStatus("username"));
    }

    // Test registerMerchant()
    public function test_register_merchant() {
        $database = new Database_Model();
        $merchant = new Merchant_Model($database);

        self::assertTrue($merchant->registerMerchant(array("username" => "merchant","email" => "merchant@merchant.com")));
    }

    // Test updateProfileInformation()
    public function test_update_profile_information() {
        $database = new Database_Model();
        $merchant = new Merchant_Model($database);

        self::assertTrue($merchant->updateProfileInformation(array("username" => "merchant","email" => "merchant@merchant.com"),"merchant"));
    }

    // Test getProfileInformation()
    public function test_get_profile_information() {
        $database = new Database_Model();
        $merchant = new Merchant_Model($database);

        self::assertTrue($merchant->getProfileInformation("merchant_username"));
    }

    // Test getAllDeliveryRequest()
    public function test_get_all_delivery_requests() {
        $database = new Database_Model();
        $merchant = new Merchant_Model($database);

        self::assertTrue($merchant->getAllDeliveryRequests());
    }

    // Test getMerchantID()
    public function test_get_merchant_id(){
        $database = new Database_Model();
        $merchant = new Merchant_Model($database);

        self::assertEquals($merchant->getMerchantID("merchant_username"),1);
    }

    // Test usernameExists()
    public function test_username_exists() {
        $database = new Database_Model();
        $merchant = new Merchant_Model($database);

        self::assertTrue($merchant->usernameExists("merchant_username"));
    }

    // Test emailExists()
    public function test_email_exists() {
        $database = new Database_Model();
        $merchant = new Merchant_Model($database);

        self::assertTrue($merchant->emailExists("merchant_email"));
    }

    // Test isPasswordChanged()
    public function test_is_password_changed() {
        $database = new Database_Model();
        $merchant = new Merchant_Model($database);

        self::assertTrue($merchant->isPasswordChanged("merchant_password"));
    }

}
<?php declare(strict_types=1);

namespace edelivery\tests;

include '../config/init.php';

use PHPUnit\Framework\TestCase;
use edelivery\models\Database_Model;

class Database_ModelTest extends TestCase {

    public function test_DB_Connected_Successfully() : void {

        $database_model = new Database_Model();

        self::assertSame("Connected successfully",$database_model->connection_status);
    }

    public function test_DB_Connection_Closes() : void {

        $database_model = new Database_Model();
        $database_model->closeDBConnection();

        self::assertEquals(null,$database_model->conn);
    }

}
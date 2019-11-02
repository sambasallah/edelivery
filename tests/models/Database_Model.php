<?php declare(strict_types=1);

namespace edelivery\tests\models;

class Database_Model {

    public function query(string $queryString) : bool {
        return !empty($queryString);
    }     

}
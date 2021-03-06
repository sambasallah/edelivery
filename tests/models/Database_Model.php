<?php declare(strict_types=1);

namespace edelivery\tests\models;

class Database_Model {

    /**
     * @param $queryString - string
     * @return bool
     * - Simulate a live database query
     */
    public function query(string $queryString) : bool {
        return !empty($queryString);
    }     

}
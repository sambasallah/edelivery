<?php declare(strict_types=1);

namespace edelivery\models;

use phpDocumentor\Reflection\Types\Nullable;

class Database_Model {

        // Database parameters
        private string $HOST = DB_HOST;
        private string  $DB_NAME = DB_NAME;
        private string $DB_PASSWORD = DB_PASSWORD;
        private string $DB_USERNAME = DB_USERNAME;

        // Database connection 
        public $conn = null;

        // Query statement
        private $query_stmt;

        // Result set
        private array $results;

        // Single result
        private object $result;

        // Keep track on the database connection status
        public $connection_status = null; 

        // Establishes connection to the database and handle possible error's during connecting to the database
        public function __construct()
        {   
            try {
                $this->conn = new \PDO("mysql:host=$this->HOST;dbname=$this->DB_NAME", $this->DB_USERNAME, $this->DB_PASSWORD);
                // set the PDO error mode to exception
                $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
                $this->connection_status =  "Connected successfully";
                }
            catch(PDOException $e)
                {
                $this->connection_status = "Connection failed: " . $e->getMessage();
                }
        }

        /**
         * @param $query - string
         * - Prepare's the query statement for execution
         */
        public function prepareQuery(string $query) : void {
            $this->query_stmt = $this->conn->prepare($query);
        }

        /**
         * @param $placeholder - string
         * @param $value
         * @param $type - null *optional 
         * - Bind placeholders in the query string
         */
        public function bind(string $placeholder,$value,$type = null) : void {
            if(\is_null($type)){
                switch(true) {
                    case \is_int( $value ) : 
                       $type = \PDO::PARAM_INT; 
                    case \is_bool( $value ) :
                        $type = \PDO::PARAM_BOOL;
                    case \is_null( $value ) : 
                        $type = \PDO::PARAM_NULL;
                    default:
                        $type = \PDO::PARAM_STR;
                }
            }
            $this->query_stmt->bindParam($placeholder,$value,$type);
        }

        /**
         * @return bool
         * - Execute query string 
         */
        public function executeQuery() : bool {
           return $this->query_stmt->execute();
        }

        /**
         * @return array
         * - Returns results set
         */
        public function getResults() : array {
            $this->executeQuery();
            $this->results = $this->query_stmt->fetchAll(\PDO::FETCH_OBJ);

            return $this->results;
        }

        /**
         * @return object
         * - Return result set
         */
        public function getResult() : object {
            $this->executeQuery();
            $this->result = $this->query_stmt->fetch(\PDO::FETCH_OBJ);

            return $this->result;
        }

        /**
         * @return int
         * - Return total number of rows in the query string
         */
        public function rows() : int {
            return $this->query_stmt->rowCount();
        }

        /**
         * - Closes the database connection
         */
        public function closeDBConnection() : void {
            $this->conn = null;
        }

}
<?php declare(strict_types=1);

namespace edelivery\models;

class Database_Model {

        // Database parameters
        private $HOST = DB_HOST;
        private  $DB_NAME = DB_NAME;
        private  $DB_PASSWORD = DB_PASSWORD;
        private  $DB_USERNAME = DB_USERNAME;

        // Database connection 
        public $conn = null;

        // Query statement
        private $query_stmt;

        // Result set
        private $results;

        // Single result
        private $result;

        // Keep track on the database connection status
        public $connection_status = null; 

        // Establishes connection to the database and handle possible error's during connecting to the database
        public function __construct()
        {   
            try {
                $this->conn = new \PDO("mysql:host=$this->HOST;dbname=$this->DB_NAME", $this->DB_USERNAME, $this->DB_PASSWORD);
                // set the PDO error mode to exception
                $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $this->connection_status =  "Connected successfully";
                }
            catch(PDOException $e)
                {
                $this->connection_status = "Connection failed: " . $e->getMessage();
                }
        }

        // Prepare query string 
        public function prepareQuery(string $query) : void {
            $this->query_stmt = $this->conn->prepare($query);
        }

        // Bind query string parameter values
        public function bind($param,$value,$type = null) : void {
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
            $this->query_stmt->bindParam($param,$value,$type);
        }

        // Execute the query string
        public function executeQuery() : bool {
           return $this->query_stmt->execute();
        }

        // Get result set
        public function getResults() : array {
            $this->executeQuery();
            $this->results = $this->query_stmt->fetchAll(\PDO::FETCH_OBJ);

            return $this->results;
        }

        // Get single result
        public function getResult() : object {
            $this->executeQuery();
            $this->result = $this->query_stmt->fetch(\PDO::FETCH_OBJ);

            return $this->result;
        }

        // Get number of rows
        public function rows() : int {
            return $this->query_stmt->rowCount();
        }

          // Closes the database connection
          public function closeDBConnection() : void{
            $this->conn = null;
        }

}
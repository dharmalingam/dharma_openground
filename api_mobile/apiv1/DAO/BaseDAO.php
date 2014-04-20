<?php

define("DB_HOST", "local.Femqueen.com");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "Femqueen");

if (!class_exists('Database')) {

    class Database extends PDO {

        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $dbname = DB_NAME;
        private $dbh;
        private $stmt;

        public function __construct() {
            // Set DSN
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
            // Set options
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            // Create a new PDO instanace
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            // Catch any errors
        }

        // Prepare
        public function query($query) {
            $this->stmt = $this->dbh->prepare($query);
        }

        // Bind
        public function bind($param, $value, $type = null) {
            if (is_null($type)) {
                switch (true) {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }
            $this->stmt->bindValue($param, $value, $type);
        }

        // Execute
        public function execute() {
            return $this->stmt->execute();
        }

        // Result Set	
        public function resultset() {
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Single
        public function single() {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Row Count
        public function rowCount() {
            return $this->stmt->rowCount();
        }

        // Last Insert Id
        public function lastInsertRow() {
            return $this->dbh->lastInsertId();
        }

        // Transactions
        public function beginTransaction() {
            return $this->dbh->beginTransaction();
        }

        public function endTransaction() {
            return $this->dbh->commit();
        }

        public function cancelTransaction() {
            return $this->dbh->rollBack();
        }

        // Debug Dump Parameters
        public function debugDumpParams() {
            return $this->stmt->debugDumpParams();
        }

    }

}
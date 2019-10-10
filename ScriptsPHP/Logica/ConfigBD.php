<?php 
    class ConfigBD {

        private $host_name;
        private $user;
        private $password;
        private $databaseName;
        
        public function __construct() {
            $this->host_name = "localhost";
            $this->user = "root";
            $this->password = "";
            $this->databaseName = "ITV";
        }
        
        public function getHOST() {
            return $this->host_name;
        }
        public function getUSER() {
            return $this->user;
        }
        public function getPASSWORD() {
            return $this->password;
        }
        public function getDATABASE() {
            return $this->databaseName;
        }
    }
?>
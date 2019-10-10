<?php 
    include("ConfigBD.php");
        
    class Conector {
        private $bd;
        public function __construct() {
            $config = new ConfigBD();
            $this->bd = mysqli_connect($config->getHOST(), $config->getUSER(),$config->getPASSWORD(),$config->getDATABASE());

        }
        public function getBD() {
            return $this->bd;
        }
        public function setBD($bd) {
            $this->bd = $bd;
        }
        public function Desconectar() {
            mysqli_close($this->bd);
        }
        public function getError() {
            return mysqli_errno($this->bd);
        }
    }
?>
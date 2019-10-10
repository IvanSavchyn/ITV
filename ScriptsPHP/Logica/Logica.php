<?php 
    include("../ModeloVo/PersonaVo.php");
    include("../ModeloDao/PersonaDao.php");
    include("Conector.php");
    class Logica {
        private $conector;
        public function __construct() {
            $this->conector = new Conector();
            
        }
        public function getBD() {
            return $this->conector->getBD();
        }
        public function CloseBD() {
            $this->conector->Desconectar();
        }
        public function getError() {
            return $this->conector->getError();
        }

    }
?>
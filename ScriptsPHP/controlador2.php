<?php 
    include("Logica/Conector.php");
    include("ModeloDao/PersonaDao.php");
    include("ModeloDao/VehiculoDao.php");
    class Controlador2 {
        private $bd;
        
        public function __construct() {
            $this->bd = new Conector();
        }
        public function ComprobarConexion() {
            if($this->bd->getBD() == null) {
                return false;
            }
            else {
                return true;
            }
        }
        public function Desconectar() {
            $this->bd->Desconectar();
        }
        public function getClientes($aceptado) {
            $personaDao = new PersonaDao($this->bd->getBD());
            return $personaDao->getClientes($aceptado);
        }
        public function getCochesNoAceptados() {
            $vehiculoDao = new VehiculoDao($this->bd->getBD());
            return $vehiculoDao->getCochesNoAceptados();
        }
        public function getCochesCliente($dni) {
            $vehiculoDao = new VehiculoDao($this->bd->getBD());
            return $vehiculoDao->getCochesCliente($dni);
        }
    }
?>
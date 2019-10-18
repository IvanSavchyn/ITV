<?php
    include("Logica/Conector.php");
    foreach ( glob(  'C:/xampp/htdocs/ITV/ITV/ScriptsPHP/ModeloVo/*.php') as $filename)
    {
        include_once $filename;
    }
    foreach ( glob(  'C:/xampp/htdocs/ITV/ITV/ScriptsPHP/ModeloDao/*.php') as $filename)
    {
        include_once $filename;
    }
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
        public function getClientePorDni($dni) {
            $personaDao = new PersonaDao($this->bd->getBD());
            return $personaDao->getClientePorDni($dni);
        }
        public function getCochesCliente($dni) {
            $vehiculoDao = new VehiculoDao($this->bd->getBD());
            return $vehiculoDao->getCochesCliente($dni);
        }
        public function getPago($matricula) {
            $pagoDao = new PagoDao($this->bd->getBD());
            return $pagoDao->getPago($matricula);
        }
        public function getBahia($id) {
            $bahia = new BahiaDao($this->bd->getBD());
            return $bahia->getBahia($id);
        }
        public function getBahias() {
            $bahia = new BahiaDao($this->bd->getBD());
            return $bahia->getBahias();
        }
        public function getParqueadero($id) {
            $parck = new ParqueaderoDao($this->bd->getBD());
            return $parck->getParqueadero($id);
        }
        public function buscarClientes() {
          $buscar = unserialize($_SESSION["user_buscar"]);
          if(!is_null($buscar)) {
              $personaDao = new PersonaDao($this->bd->getBD());
              return $personaDao->buscarClientes($buscar->getDni(), $buscar->getNombre(), $buscar->getApellidos(), $buscar->getEmail(), $buscar->getTelefono());
          }
          else {
              return null;
          }
        }
    }

?>

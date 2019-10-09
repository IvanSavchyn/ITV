<?php 
    class VehiculoVo {
        private $id;
        private $marca;
        private $idPersona;
        private $idTipo;
        
        public function __construct($id, $marca, $idPersona, $idTipo) {
            $this->id = $id;
            $this->marca = $nombre;
            $this->idPersona = $idPersona;
            $this->idTipo = $idTipo;
        }
        public function setId($id) {
            $this->id = $id;
        }
        public function setMarca($narca) {
             $this->marca = $nombre;
        }
        public function setIdPersona($IdPersona) {
            $this->idPersona = $idPersona;
        }
        public function setIdTipo($idTipo) {
            $this->idTipo = $idTipo;
        }
        public function getId() {
            return $this->id;
        }
        public function getMarca() {
            return $this->marca;
        }
        public function getIdPersona() {
            return $this->idPersona;
        }
        public function getidTipo() {
            return $this->idTipo;
        }
    }
?>
<?php
    class VehiculoVo {
        private $id;
        private $marca;
        private $aceptado;
        private $idPersona;
        private $idTipo;

        public function __construct($id, $marca, $aceptado, $idPersona, $idTipo) {
            $this->id = $id;
            $this->marca = $marca;
            $this->aceptado = $aceptado;
            $this->idPersona = $idPersona;
            $this->idTipo = $idTipo;
        }
        public function setId($id) {
            $this->id = $id;
        }
        public function setMarca($narca) {
             $this->marca = $nombre;
        }
        public function setAceptado($aceptado) {
            $this->aceptado = $aceptado;
        }
        public function setIdPersona($IdPersona) {
            $this->idPersona = $idPersona;
        }
        public function setTipo($idTipo) {
            $this->idTipo = $idTipo;
        }

        
        public function getId() {
            return $this->id;
        }
        public function getMarca() {
            return $this->marca;
        }
        public function getAceptado() {
            return $this->aceptado;
        }
        public function getIdPersona() {
            return $this->idPersona;
        }
        public function getTipo() {
            return $this->idTipo;
        }
    }
?>
